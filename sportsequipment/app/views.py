from django.shortcuts import render
from django.http import JsonResponse
from django.contrib.auth import authenticate, login, logout
from .models import Users, Message, Equipment, Repair, Order
from sportsequipment.settings import MEDIA_ROOT
import datetime
import base64
import os
import shutil

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

    def test(request):
        return render(request, 'test.html')
    def equipment_next_status(status):
        if status == "空闲中":
            return "已租出"
        return "空闲中"
    def order_next_status(status):
        if status == "待领取":
            return "未归还"
        elif status == "未归还":
            return "已归还"
        elif status == "已归还":
            return "已完成"
        return "已完成"
class model:
    def load_index(email):
        user = Users.objects.filter(email=email).first()
        messages = Message.objects.filter(user=user,read=False)
        equipments = Equipment.objects.filter(status="空闲中").order_by('-count')
        return locals()
    def load_equipment(email, eid):
        user = Users.objects.filter(email=email).first()
        messages = Message.objects.filter(user=user, read=False)
        equipment = Equipment.objects.filter(eid=eid).first()
        return locals()

    def load_message(email):
        user = Users.objects.filter(email=email).first()
        messages = Message.objects.filter(user=user)
        unread_messages = Message.objects.filter(read=False)
        for message in messages:
            message.part = message.content[0:30]
            print(message.part)
        return locals()
    def load_repair(email):
        user = Users.objects.filter(email=email).first()
        repairs = Repair.objects.filter(user=user)
        return locals()
    def load_manage_repair(email):
        user = Users.objects.filter(email=email).first()
        repair1 = Repair.objects.filter()
        repairs = []
        for repair in repair1:
            if repair.equipment.controller == user:
                repairs.append(repair)
        return locals()
    def load_repair(email):
        user = Users.objects.filter(email=email).first()
        messages = Message.objects.filter(user=user, read=False)
        return locals()

    def modify_wallet(user,number):
        if(user.wallet+number>=0):
            user.wallet += number
            user.save()
            return True
        return False
    def do_borrow(email, eid, consume):
        user = Users.objects.filter(email=email).first()
        equipment = Equipment.objects.filter(eid=eid).first()
        if model.modify_wallet(user, -int(consume)):
            order = Order.objects.create(
                user=user,
                equipment=equipment,
                status="待领取",
                rent_time=datetime.date.today(),
                return_time=datetime.date.today()+datetime.timedelta(days=int(consume))
            )
            order.save()
            equipment.status = "已租出"
            equipment.count += 1
            equipment.save()
        return True
    def get_message( email, mid):
        user = Users.objects.filter(email=email).first()
        messages = Message.objects.filter(user=user, read=False)
        message = Message.objects.filter(mid=mid).first()
        return locals()

    def read_message(email, mid):
        user = Users.objects.filter(email=email).first()
        message = Message.objects.filter(mid=mid).first()
        message.read = True
        message.save()
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

    def do_register(name, uid, email, password):
        message = ""
        try:
            user = Users.objects.create(
                name=name,
                uid=uid,
                email=email,
                password=password,
                img_url="head/"+uid+".png",
                wallet=7
            )
            user.save()
            #默认头像
            dir1 = os.path.join(MEDIA_ROOT, "head/A19190248.png")
            dir2 = os.path.join(MEDIA_ROOT, str(user.img_url))
            shutil.copyfile(dir1, dir2)

            ok = True
            print("success register user")
            print(user)
        except Exception:
            print(Exception)
            message = "注册失败，请检查学号以及邮箱或稍后再试！"
            ok = False
            # locals()返回当前函数所有局部变量的字典
        print(message)
        return ok, locals()

    def add_equipment(email, ename, brand, price, img_url, introduce, number):
        user = Users.objects.filter(email=email).first()
        for i in range(number):
            equipment = Equipment.objects.create(
                ename=ename,
                brand=brand,
                price=price,
                introduce=introduce,
                controller=user
            )
            equipment.save()
            equipment.img_url = "goods/"+equipment.eid+".png"
            equipment.save()
        return locals()

    def get_borrow(email):
        user = Users.objects.filter(email=email).first()
        orderstemp = Order.objects.filter()
        orders = []
        for i in orderstemp:
            if i.equipment.controller == user:
                orders.append(i)
        print(orders)
        return locals()

    def recive_equipment(email, oid):
        user = Users.objects.filter(email=email).first()
        unread_messages = Message.objects.filter(user=user, read=False)
        order = Order.objects.filter(oid=oid).first()
        if order.status != "待领取":
            orders = Order.objects.filter(user=user).order_by('-oid')
            return locals()
        order.status = common.order_next_status(order.status)
        order.save()
        orders = Order.objects.filter(user=user).order_by('-oid')
        return locals()

    def return_equipment(email, oid):
        user = Users.objects.filter(email=email).first()
        unread_messages = Message.objects.filter(user=user, read=False)
        order = Order.objects.filter(oid=oid).first()
        if order.status != "未归还":
            orders = Order.objects.filter(user=user).order_by('-oid')
            return locals()
        order.status = common.order_next_status(order.status)
        order.equipment.status = common.equipment_next_status(order.equipment.status)
        order.equipment.save()
        order.save()
        print(order.equipment.status)
        orders = Order.objects.filter(user=user).order_by('-oid')
        return locals()


class homepage:
    def home(request):
        return render(request, 'home.html')
class loginpage:
    def login(request):
        return render(request, 'login.html')

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
            ok = model.do_borrow(email, request.GET.get('eid'), request.GET.get('consume'))
            print(ok)
            context = model.load_index(email)
            return render(request, 'index.html', context)
        return render(request, 'login.html')

    def get_equipment(request):
        cookie1 = request.COOKIES.get('test')
        eid = request.GET.get('eid')
        if common.checkcookie(cookie1):
            email = common.get_email_by_cookie(cookie1)
            context = model.load_equipment(email, eid)
            return render(request, 'equipment.html', context)

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
            model.read_message(email,mid)
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

    def submit_repair(request):
        cookie1 = request.COOKIES.get('test')
        oid = request.POST.get("oid")
        reason = request.POST.get("reason")
        if common.checkcookie(cookie1):
            print(oid, reason)
            return render(request, 'login.html')
        return render(request, 'login.html')
class registerpage:
    def register(request):
        return render(request,'register.html')
    def do_register(request):
        name = request.POST['user_name']
        uid = request.POST['uid']
        email = request.POST['email']
        password = request.POST['password']
        ok, context = model.do_register(name, uid, email, password)
        if ok:
            return render(request, 'login.html')
        return render(request, 'register.html', context)
class myrentpage:
    def myrent(request):
        cookie1 = request.COOKIES.get('test')
        if common.checkcookie(cookie1):
            email = common.get_email_by_cookie(cookie1)
            user = Users.objects.filter(email=email).first()
            orders = Order.objects.filter(user_id=user.uid).order_by('-oid')
            return render(request, 'myrent.html', locals())
        return render(request,'login.html')
    def recive_equipment(request):
        cookie1 = request.COOKIES.get('test')
        oid = request.GET.get('oid')
        if common.checkcookie(cookie1):
            email = common.get_email_by_cookie(cookie1)
            context = model.recive_equipment(email, oid)
            return render(request, 'myrent.html', context)
        return render(request, 'login.html')
    def return_equipment(request):
        cookie1 = request.COOKIES.get('test')
        oid = request.GET.get('oid')
        if common.checkcookie(cookie1):
            email = common.get_email_by_cookie(cookie1)
            context = model.return_equipment(email, oid)
            return render(request, 'myrent.html', context)
        return render(request, 'login.html')
class settingpage:
    def setting(request):
        cookie1 = request.COOKIES.get('test')
        if common.checkcookie(cookie1):
            email = common.get_email_by_cookie(cookie1)
            user = Users.objects.filter(email=email).first()
            return render(request, 'setting.html', {"user": user})
        else :
            return render(request,'login.html')

class managepage:
    def add_equipment(request):
        cookie1 = request.COOKIES.get('test')
        ename = request.POST.get('ename')
        brand = request.POST.get('brand')
        price = request.POST.get('price')
        img = request.POST.get('img')
        introduce = request.POST.get('introduce')
        if common.checkcookie(cookie1):
            email = common.get_email_by_cookie(cookie1)
        else:
            email = "1459576020@qq.com"
        context = model.add_equipment(email, ename, brand, price, img, introduce)
        return render(request, 'login.html', context)

    def borrow(request):
        cookie1 = request.COOKIES.get('test')
        if common.checkcookie(cookie1):
            email = common.get_email_by_cookie(cookie1)
        else:
            email = "1459576020@qq.com"
        context = model.get_borrow(email)
        return render(request, 'manage_borrow.html', context)

    def repair(request):
        cookie1 = request.COOKIES.get('test')
        if common.checkcookie(cookie1):
            email = common.get_email_by_cookie(cookie1)
        else:
            email = "1459576020@qq.com"
        context = model.load_manage_repair(email)
        return render(request, 'manage_repair.html', context)