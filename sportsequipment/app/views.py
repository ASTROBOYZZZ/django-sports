from django.shortcuts import render
from django.http import JsonResponse
from django.contrib.auth import authenticate, login, logout
from .models import Users
from .models import Equipment
from .models import Repair
from .models import Order
from .models import Message
import base64

class common:
    # 判断ajax请求
    def is_ajax(request):
        return request.META.get('HTTP_X_REQUESTED_WITH') == 'XMLHttpRequest'
    # 签名函数
    def sign(str):
        return str + "|" + str[::-1]
    # 检查cookie是否被篡改
    def checkcookie(str):
        if str == None:
            return False
        length = len(str)
        return str[int(length / 2)] == '|' and str == str[::-1]

    def get_email_by_cookie(str):
        length = len(str)
        return str[0:int(length / 2)]
    def search_equipment_by_eid(eid):
        equipment = Equipment.objects.filter(eid=eid).first()
        if not equipment:
            message = "请输入正确设备id"
        return locals()
    def modify_equipment_status(eid,status):
        equipment = Equipment.objects.filter(eid=eid).first()
        if not equipment:
            message = "请输入正确设备id"
        return locals()
        equipment.status = status
        equipment.save()
class model:
    def load_index(email):
        user = Users.objects.filter(email=email).first()
        messages = Message.objects.filter(user=user,read=False)
        equipments = Equipment.objects.filter(status="空闲中").order_by('-count')
        return locals()
    def load_message(email):
        user = Users.objects.filter(email=email).first()
        messages = Message.objects.filter(user=user,read=False)
        message = messages.first()
        for message in messages:
            message.part = message.content[0:30]
        print(message.part)
        return locals()
    def load_repair(email):
        user = Users.objects.filter(email=email).first()
        messages = Message.objects.filter(user=user, read=False)
        return locals()
    def borrow(email, eid):
        return True
    def get_message( email, mid):
        user = Users.objects.filter(email=email).first()
        message = Message.objects.filter(mid=mid).first()
        return locals()
    def do_login(email, password):
        user = Users.objects.filter(email=email, password=password).first()
        if user:
            context = model.load_index(email)
            return True, context
        else:
            message = "请检查您的账号密码"
        return False, locals()
    def delete_message(email,mid):
        user = Users.objects.filter(email=email).first()
        message = Message.objects.filter(mid=mid, user=user).first()
        message.delete()
        messages = Message.objects.filter(mid=mid)
        return locals()
class homepage:
    def home(request):
        return render(request , 'home.html')
class loginpage:
    def login(request):
        return render(request,'login.html')

    def do_login(request):
        email = request.POST.get('email')
        password = request.POST.get('password')
        ok,context = model.do_login(email, password)
        print(email, password)
        response = render(request, 'index.html', context)
        if ok:
            response.set_cookie("test", common.sign(email), 86400)
        return response
    def logout(request):
        response = render(request, 'login.html')
        response.delete_cookie("test")
        return response
class indexpage:
    def index(request):
        cookie1 = request.COOKIES.get('test')
        if common.checkcookie(cookie1):
            email = common.get_email_by_cookie(cookie1)
            context = model.load_index(email)
            return render(request, 'index.html', context)
        return render(request, 'login.html')
    def do_borrow(request):
        cookie1 = request.COOKIES.get('test')
        if common.checkcookie(cookie1):
            email = common.get_email_by_cookie(cookie1)
            ok = model.borrow(email,request.GET.get('eid'))
            print(ok)
            context = model.load_index(email)
            return render(request, 'index.html', context)
        return render(request, 'login.html')
class messagepage:
    def message(request):
        cookie1 = request.COOKIES.get('test')
        if common.checkcookie(cookie1):
            email = common.get_email_by_cookie(cookie1)
            context = model.load_message(email)
            return render(request, 'message.html', context)
        return render(request, 'login.html')
    def get_message(request):
        cookie1 = request.COOKIES.get('test')
        mid = request.GET.get('mid')
        if common.checkcookie(cookie1):
            email = common.get_email_by_cookie(cookie1)
            context = model.get_message(email,mid)
            return render(request, 'messagedetail.html', context)
        return render(request,'login.html')
    def delete_message(request):
        cookie1 = request.COOKIES.get('test')
        mid = request.COOKIES.get('test')
        if common.checkcookie(cookie1):
            email = common.get_email_by_cookie(cookie1)
            context = model.delete_message(email, mid)
            return render(request, 'messagedetail.html', context)
        return render(request, 'login.html')
    def read_messagedetail(request):
        cookie1 = request.COOKIES.get('test')
        if common.checkcookie(cookie1):
            email = common.get_email_by_cookie(cookie1)
            user = Users.objects.filter(email=email).first()
            return render(request, 'messagedetail.html', {"user": user})
        return render(request, 'login.html')
class repairpage:
    def repair(request):
        cookie1 = request.COOKIES.get('test')
        if common.checkcookie(cookie1):
            email = common.get_email_by_cookie(cookie1)
            context = model.load_repair(email)
            return render(request, 'repair.html', context)
        return render(request,'login.html')

    def do_repair(request):
        cookie1 = request.COOKIES.get('test')
        eid = request.POST.get("equipment_id")
        reason = request.POST.get("reason")
        if common.checkcookie(cookie1):
            email = common.get_email_by_cookie(cookie1)
            user = Users.objects.filter(email=email).first()
            try:
                repair = Repair.objects.create(
                    equipment_id=eid,
                    reason=reason,
                )
                user.save()
                print("success register user")
                print(user)
            except Exception:
                print(Exception)
                message = "注册失败，请检查学号以及邮箱或稍后再试！"
                return render(request, 'register.html', locals())
                # locals()返回当前函数所有局部变量的字典
            return render(request, 'repair.html', {"user": user})
        return render(request, 'login.html')
class registerpage:
    def register(request):
        return render(request,'register.html')
    def do_register(request):
        name = request.POST['user_name']
        uid = request.POST['uid']
        email = request.POST['email']
        password = request.POST['password']
        message = ""
        try:
            user = Users.objects.create(
                name=name,
                uid=uid,
                email=email,
                password=password,
            )
            user.save()
            print("success register user")
            print(user)
        except Exception:
            print(Exception)
            message = "注册失败，请检查学号以及邮箱或稍后再试！"
            return render(request, 'register.html', locals())
            # locals()返回当前函数所有局部变量的字典
        print(message)
        return render(request, 'login.html')
class myrentpage:
    def myrent(request):
        cookie1 = request.COOKIES.get('test')
        if common.checkcookie(cookie1):
            email = common.get_email_by_cookie(cookie1)
            user = Users.objects.filter(email=email).first()
            orders = Order.objects.filter(user_id=user.uid).order_by('-oid')
            return render(request, 'myrent.html', locals())
        return render(request,'login.html')
class settingpage:
    def setting(request):
        cookie1 = request.COOKIES.get('test')
        if common.checkcookie(cookie1):
            email = common.get_email_by_cookie(cookie1)
            user = Users.objects.filter(email=email).first()
            return render(request, 'setting.html', {"user": user})
        else :
            return render(request,'login.html')

