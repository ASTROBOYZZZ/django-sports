"""sportsequipment URL Configuration

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/4.1/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  path('', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  path('', Home.as_view(), name='home')
Including another URLconf
    1. Import the include() function: from django.urls import include, path
    2. Add a URL to urlpatterns:  path('blog/', include('blog.urls'))
"""
from django.contrib import admin
from django.urls import path

from django.contrib import admin
from django.conf.urls import include
from django.urls import path, include, re_path
from django.views.static import serve
from sportsequipment.settings import MEDIA_ROOT

app_name = 'app'

urlpatterns = [
    path('admin/', admin.site.urls),
    path('', include('app.urls')),
    # 处理图片显示的url,使用Django自带serve,传入参数告诉它去哪个路径找，我们有配置好的路径MEDIAROOT
    re_path(r'^media/(?P<path>.*)', serve, {"document_root": MEDIA_ROOT }),
    # url(r'^media/(?P<path>.*)$',serve,{"document_root":MEDIA_ROOT}),
    # path('' , views.home , name='home'), #添加映射
]
