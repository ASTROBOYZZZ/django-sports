# Generated by Django 4.1.7 on 2023-03-31 09:34

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('app', '0011_remove_message_author'),
    ]

    operations = [
        migrations.AddField(
            model_name='users',
            name='wallet',
            field=models.BigIntegerField(default=0, verbose_name='余额'),
        ),
    ]
