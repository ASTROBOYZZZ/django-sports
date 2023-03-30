from django.shortcuts import render
from django.http import JsonResponse
from django.contrib.auth import authenticate, login, logout
from .models import Users
from .models import Equipment
from .models import Repair
from .models import Order
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

# Create your views here.+

class model:

    def load_index(email):
        user = Users.objects.filter(email=email).first()
        equipments = Equipment.objects.filter(status="空闲中").order_by('-count')
        return locals()
    def borrow(email,eid):
        return True

class homepage:
    def home(request):
        return render(request , 'home.html')

class loginpage:
    def login(request):
        return render(request,'login.html')

    def do_login(request):
        response = {'status': 100, 'msg': None}
        email = request.POST.get('email')
        password = request.POST.get('password')

        user = Users.objects.filter(email=email, password=password).first()
        if user:
            response['msg'] = "登录成功"
        else:
            response['status'] = 101
            response['msg'] = "用户名或密码错误"
        print(email, password, response)
        response = JsonResponse(response)
        if user:
            response.set_cookie("test", common.sign(email), 86400)
        return response
        # json.dumps(response),序列化得到一个json格式的字符串，js会将后台传过来的数据当做字符串进行处理
        # return  HttpResponse(json.dumps(response))
        # return redirect('http://www.baidu.com')
        # return render(request,'login.html')

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
            user = Users.objects.filter(email=email).first()
            return render(request, 'message.html', {"user": user})
        return render(request,'login.html')
class repairpage:
    def repair(request):
        cookie1 = request.COOKIES.get('test')
        if common.checkcookie(cookie1):
            email = common.get_email_by_cookie(cookie1)
            user = Users.objects.filter(email=email).first()
            return render(request, 'repair.html', {"user": user})
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

