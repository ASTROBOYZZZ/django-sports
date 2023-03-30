# Generated by Django 4.1.7 on 2023-03-24 10:44

from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    dependencies = [
        ('app', '0001_initial'),
    ]

    operations = [
        migrations.AlterField(
            model_name='users',
            name='email',
            field=models.CharField(default='1459576020@qq.com', max_length=20, unique=True, verbose_name='邮箱'),
        ),
        migrations.CreateModel(
            name='Equipment',
            fields=[
                ('eid', models.CharField(max_length=20, primary_key=True, serialize=False, verbose_name='设备id')),
                ('ename', models.CharField(max_length=20, verbose_name='设备名称')),
                ('brand', models.CharField(max_length=12, verbose_name='品牌')),
                ('purchase_date', models.DateField(verbose_name='购买日期')),
                ('price', models.CharField(max_length=20, verbose_name='价格')),
                ('controller', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='app.users')),
            ],
            options={
                'db_table': 'equipment',
            },
        ),
    ]