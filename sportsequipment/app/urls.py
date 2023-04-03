from django.urls import path
from django.conf.urls import include
from . import views

app_name = 'app'

urlpatterns = [
    path('test' , views.common.test , name='test'),


    # 8个html页面
    path('' , views.homepage.home , name='home'), #添加映射
    path('index' , views.indexpage.index , name='index'),
    path('login', views.loginpage.login, name='login'),
    path('message', views.messagepage.message, name='message'),
    path('repair' , views.repairpage.repair , name='repair'),
    path('register', views.registerpage.register, name='register'),
    path('myrent', views.myrentpage.myrent, name='myrent'),
    path('setting', views.settingpage.setting, name='setting'),
    path('manage_borrow',views.managepage.borrow,name='manage_borrow'),
    path('manage_repair',views.managepage.repair,name='manage_repair'),





    path('do_login', views.loginpage.do_login, name='do_login'),
    path('logout', views.loginpage.logout, name='logout'),
    path('do_register', views.registerpage.do_register, name='do_register'),
    path('do_borrow', views.indexpage.do_borrow, name='do_borrow'),
    path('get_message', views.messagepage.get_message, name='get_message'),
    path('get_equipment', views.indexpage.get_equipment, name='get_equipment'),
    path('recive_equipment', views.myrentpage.recive_equipment, name='recive_equipment'),
    path('return_equipment', views.myrentpage.return_equipment, name='return_equipment'),
    path('delete_message', views.messagepage.get_message, name='delete_message'),
    path('read_message', views.messagepage.get_message, name='read_message'),
    path('submit_repair', views.repairpage.submit_repair, name='submit_repair'),

]
