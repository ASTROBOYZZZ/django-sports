from django.urls import path
from django.conf.urls import include
from . import views

app_name = 'app'

urlpatterns = [
    # 8个html页面
    path('' , views.homepage.home , name='home'), #添加映射
    path('index' , views.indexpage.index , name='index'),
    path('login', views.loginpage.login, name='login'),
    path('message', views.messagepage.message, name='message'),
    path('repair' , views.repairpage.repair , name='repair'),
    path('register', views.registerpage.register, name='register'),
    path('myrent', views.myrentpage.myrent, name='myrent'),
    path('setting', views.settingpage.setting, name='setting'),





    path('do_login', views.loginpage.do_login, name='do_login'),
    path('logout', views.loginpage.logout, name='logout'),
    path('do_register', views.registerpage.do_register, name='do_register'),
    path('do_borrow', views.indexpage.do_borrow, name='do_borrow'),

]
