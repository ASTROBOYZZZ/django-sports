from django.db import models

# Create your models here.
class Users(models.Model):
    uid = models.AutoField('用户id', primary_key=True)
    name = models.CharField("姓名", max_length=20, null=False)
    password = models.CharField("密码", max_length=20, null=False)

    class Meta:
        db_table = "users"


