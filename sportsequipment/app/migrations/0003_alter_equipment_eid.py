# Generated by Django 4.1.7 on 2023-03-25 12:43

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('app', '0002_alter_users_email_equipment'),
    ]

    operations = [
        migrations.AlterField(
            model_name='equipment',
            name='eid',
            field=models.BigAutoField(primary_key=True, serialize=False, verbose_name='设备id'),
        ),
    ]