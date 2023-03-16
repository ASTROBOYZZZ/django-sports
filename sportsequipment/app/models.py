from django.db import models

# Create your models here.
class Users(models.Model):
    uid = models.CharField('学号', max_length=20, null=False, primary_key=True)
    name = models.CharField("姓名", max_length=20, null=False)
    password = models.CharField("密码", max_length=12, null=False)
    email = models.CharField("邮箱",max_length=20, null=False,default="1459576020@qq.com")
    class Meta:
        db_table = "users"


