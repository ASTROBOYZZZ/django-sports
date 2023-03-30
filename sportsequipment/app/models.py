from django.db import models

# Create your models here.
class Users(models.Model):
    uid = models.CharField('学号', max_length=20, null=False, primary_key=True)
    name = models.CharField("姓名", max_length=20, null=False)
    password = models.CharField("密码", max_length=12, null=False)
    email = models.CharField("邮箱",max_length=20, null=False,default="1459576020@qq.com",unique = True)
    img_url = models.ImageField(upload_to='img_url/', verbose_name=u"图片地址")
    manage = models.BooleanField("管理员",default=False)
    class Meta:
        db_table = "users"

class Equipment(models.Model):
    eid = models.BigAutoField('设备id',primary_key=True)
    ename = models.CharField("设备名称", max_length=20, null=False)
    brand = models.CharField("品牌", max_length=12, null=False)
    purchase_date = models.DateField("购买日期",auto_now_add=True, null=False)
    price = models.CharField("价格",max_length=20, null=False)
    controller = models.ForeignKey(to=Users, on_delete=models.CASCADE)
    count = models.IntegerField("借出次数",default=0)
    status = models.CharField("状态",max_length=20,default="空闲中")
    img_url = models.ImageField(upload_to='img_url/',verbose_name=u"图片地址")
    introduce = models.TextField('设备描述')
    # 空闲中，已租出，维修中
    class Meta:
        db_table = "equipment"

class Order(models.Model):
    oid = models.BigAutoField('租赁编号',primary_key=True)
    user = models.ForeignKey(to=Users, on_delete=models.CASCADE)
    equipment = models.ForeignKey(to=Equipment, on_delete=models.CASCADE)
    rent_time = models.DateField("租赁时间", auto_now_add=True, null=False)
    return_time = models.DateField("归还时间", auto_now=True, null=False)
    status = models.CharField("状态", max_length=20,default="未归还")
    # 未归还，已归还，已结束
    class Meta:
        db_table = "order"

class Repair(models.Model):
    fid = models.BigAutoField('维修编号',primary_key=True)
    user = models.ForeignKey(to=Users, on_delete=models.CASCADE)
    equipment = models.ForeignKey(to=Equipment, on_delete=models.CASCADE)
    reason = models.TextField("状态", max_length=20,default="待处理")
    apply_time = models.DateField("维修上报时间", auto_now_add=True, null=False)
    solve_time = models.DateField("处理时间", auto_now=True, null=False)
    status = models.CharField("状态", max_length=20,default="待处理")
    # 待处理，器材维修完毕，器材无法维修
    class Meta:
        db_table = "repair"