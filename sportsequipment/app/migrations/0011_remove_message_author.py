# Generated by Django 4.1.7 on 2023-03-30 11:25

from django.db import migrations


class Migration(migrations.Migration):

    dependencies = [
        ('app', '0010_rename_mail_message_alter_message_table'),
    ]

    operations = [
        migrations.RemoveField(
            model_name='message',
            name='author',
        ),
    ]
