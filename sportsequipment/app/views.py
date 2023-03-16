from django.shortcuts import render
from django.http import JsonResponse
from .models import Users


# Create your views here.
def home(request):
    return render(request , 'home.html')

def search(request):
    print(request.POST)
    return render(request , 'home.html')

def gettime(request):
    if request.POST=="唐孝天":
        return render(request , 'home.html')

def is_ajax(request):
    return request.META.get('HTTP_X_REQUESTED_WITH') == 'XMLHttpRequest'


def login(request):
    if request.method=='GET':
        return render(request,'login.html')
    # elif request.method=='POST':
    elif is_ajax(request):               #使用is_ajax可以更加的明了
        response={'status':100,'msg':None}
        name=request.POST.get('username')
        password=request.POST.get('password')

        user=Users.objects.filter(uid=name,password=password).first()
        if user:
            response['msg']="登录成功"
        else:
            response['status']=101
            response['msg'] = "用户名或密码错误"
        print(name,password,response)
        return  JsonResponse(response)
        # json.dumps(response),序列化得到一个json格式的字符串，js会将后台传过来的数据当做字符串进行处理
        # return  HttpResponse(json.dumps(response))
        # return redirect('http://www.baidu.com')
        # return render(request,'login.html')

def register(request):
    return render(request,'register.html')
