# Generated by Django 4.1.7 on 2023-03-30 11:02

from django.db import migrations


class Migration(migrations.Migration):

    dependencies = [
        ('app', '0009_rename_fid_repair_rid_alter_repair_reason_mail'),
    ]

    operations = [
        migrations.RenameModel(
            old_name='Mail',
            new_name='Message',
        ),
        migrations.AlterModelTable(
            name='message',
            table='message',
        ),
    ]