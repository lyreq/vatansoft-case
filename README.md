


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## VatanSoft Test Case

Laravel'in pasaport kütüphanesini kullandım. Üye e-posta ve şifre bilgilerini JSON formatında alıp token oluşturdum. Daha sonra bu token ile diğer hizmetlere erişim verdim. Bu token olmadan diğer hizmetlere erişilemez.

## Proje Kurulumu

1) Composer'ı kurun

		composer install
2) Yeni bir env dosyası oluşturun

		cp .env.example .env	
3) Yeni bir key oluşturun

		php artisan key:generate
4) Env dosyasında veritabanı bağlantısını kurun.

		DB_DATABASE=db_name

		DB_USERNAME=db_user

		DB_PASSWORD=db_password
	
5) Projeyi migrate edip aynı zamanda seedleri çalıştırıp örnek dataları çekelim

		php artisan migrate --seed
6) Passport kütüphanesini çalıştıralım

		php  artisan  passport:install

7) Projeyi çalıştıralım

		php artisan serve
		
8) Kuyruğu çalıştıralım

	    php artisan queue:work  

9) İsterseniz test işlemlerini çalıştırabilirsiniz.

	    php artisan test


## ## Servislerin Kullanımı
####	
Postman koleyksiyonuna [buradan](https://drive.google.com/file/d/16F-2sKiVqg3zBLyq1vRxVXUKQouUSRCF/view?usp=sharing) erişebilirsiniz 
Postman Koleksiyonun değişkenler bölümünde base-url ve token bilgilerini kendinize göre ayarlamayı unutmayın.
Seed çalıştırırsanız varsayılan giriş bilgileriniz aşağıdaki gibi olacaktır. 

	    Email: info@vatansoft.com	
	    Password: password

## 1. POST /api/auth/login:
Kullanıcı giriş işlemi içindir. Giriş yaptıktan sonra token ve token tipi döndürecektir.

Örnek İstek (JSON):

    {
	    "email":"info@vatansoft.com",
	    "password":  "password"
    }

Örnek Sonuç:

    {
    "status": "success",
    "code": 200,
    "message": "Transaction Successfuly!",
    "data": {
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYTJkYzhhNzg0YjNlNjc5ZmVmNmUxMWYzMmZjMDAzYWE1NzljMDVlZWU4ZmNhZGY3Y2VkNTc2OGVjZjk5YzgyNTM0MWNiZThjMjQzY2JlMDQiLCJpYXQiOjE3MDQ4NzE3OTMuNTM5NDkzLCJuYmYiOjE3MDQ4NzE3OTMuNTM5NDk0LCJleHAiOjE3MzY0OTQxOTMuNTM1MDY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.cIK-VkeSXqEPUZoiBYzCzVEGP147712fPBZBJjAM5KkhE6DdpFzhvaqHTf3TPJpqNJW9w5X5FCbPhjrXSKn5dIlBavOKSFCfA3ZDFOQ2Q_ojqRVr0XorcxPj209RAmJeJ0w6IUe6tYGbPtg6Sr8mqUvT9UrQp2wTI37llUzXVt-qGwJsLjdn_lutCFbZQwb5TWw6K3RxCYvyskdYtQDlu4gPkUnqX8hL8Nu-TzChAQomDmvucTqvLnIvejXmtZjpNmcw0uoYk47szh9-U7eWBUfPyENUCWnDHW5zGZcZfgt-RzJRApuSl49SRyDxCkyl_wMBldkrZfvgDa7bu-dsvxPliK3t7g_OStM4a89HdtknPf2Bc81t3KysRqLWU8HhOHC48eD-U-HHzO7aIisB5sBLU9QBxhMdfY_bub99J9b-KR6Ujx4VN2A5LHFjaBDsPi4zjiq5lWfzV6TM-f61TF-FOYFbA9Vxpi2M2jqh_P4HWJdoVoV6r8geBiRaFvt-XH6fX2ylBuLhB5hG6gAq8CwVO91vYRIIIqElwQ65LvPtxY0bullyIgQ9PGM0fkJnKSBgkzzIayjsORYSmq098Ex4qE6EzOV1TdcFPa6LlUzqJ1ML9BhTZizt1KXoX1jOas7oWdGfoqL3yhov3lyUG3KQWQNP2GtWBSnNpn0_4WQ",
        "token_type": "Bearer"
    }
}

## 2. GET /api/auth/register:
Kullanıcı kayıt işlemi içindir. Kayıt olduktan sonra token ve token tipi döndürecektir.
Örnek İstek (JSON):

    {

		"name":  "Test Test",
		"email":  "test1@gmail.com",
		"password":  "password",
		"password_confirmation":  "password"

	}


Örnek Sonuç:

    {
    "status":  "success",
    "code":  200,   
    "message":  "Transaction Successfuly!",
    "data":  {
    "access_token":  "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMWQ3OThhNDMxMzU1YWRkNjVjODUzZWU2NWM3Y2NjY2JjZGNjYzlmNjczNjI4Y2ZiMzViNmU2MDIxZmVjNWYxNjcyY2EzZTg0ZGM5NjA1ZTIiLCJpYXQiOjE3MDQ4Mzg4NzQuMTU0NDIsIm5iZiI6MTcwNDgzODg3NC4xNTQ0MjEsImV4cCI6MTczNjQ2MTI3NC4xNTMzMzUsInN1YiI6IjIiLCJzY29wZXMiOltdfQ.mbb41iqnbzs94cp9skJqeUYn3PasXFAYBgoPecIrjfnC8rrSeTzUIZz5Y8ImQvoYXGV7uBuV40qlsIOVo_tdoxJGeWeuWy3zp_9tWLWFI8Jzsp-IKHam1m4IsRZglCq0rc7hbkemeIkJ50YiZbhr_nmhh9rj06OCHyb1ykc29XDMwEY8ctj1EnmRCSPu4AqbHV3F1HgNWwW7xf-UaEFk53b7ABrsTaA9qSARlLOhva2uUQcVcp1186kbDaGA1EzPz5eVttlsuIb840fW9NPP_Z0RVwyuVT09DpJ8u5u8ENqdY9CSue3fxxSUw8m6Amwx9-JAsbmNhMXKdGlMHKKTMkA15UCfciUsk7avtt_ZcpYbsmr_lRY9qkxsAUTRlY7-pArmVrLGlQ0s7cOfuKeKPcMjfUSrm4wPvYslyAuaArB74gkBGrMCcMI85hNsByrHxzVnQ4nKMY3tWDu8ZC4a1jOEHIjhAuiEUig4qD0k_czfexTmkIs86YPlG0qvG-UU3nyg-SI1yOhLhnZwK8O1qzSCYAbMFFBivyGoeSUBHS8VsJ9XAT1Dm8Ic__6e9BAZzUqEHE9Kzva7uLUO51uPQtSxl05pc5XAw6b1Oo5AtOxW1unhafNFQL0ANZiqCzG-jmCwxDLyRBDQRu2t8Y-A97Po554EBT0kJXwdG92fTrE",
    "token_type":  "Bearer"
    }
    }


## 3. Post /api/sms/send:
SMS gönderme servisidir. Çoklu sms gönderilebilir. Sisteme gönderilen SMS'ler 500'ü aştığında kuyruğa atıp job ile sms gönderim yapmaktadır.
Örnek İstek (JSON):

    [
	    {
	    "number":  "123123123",
	    "message":  "test mesaj 1"
	    },
	    {
	    "number":  "123123123",
	    "message":  "test mesaj 1"
	    }
    ]

Örnek Sonuç:

        {
		    "status":  "success",
		    "code":  200,
		    "message":  "Transaction Successfuly!"
	    }

## 4. GET /api/sms:
Tüm SMS isteklerinin listelesini verir. Sorgu da GET ile send_time gönderilirse o tarihden önceki gönderilen sms istekleri listelenir

Örnek İstek:

| Sorgu Paramteresi | İstek Tipi | **Örnek Değer** | Zorunluluk |
| --- | --- | --- |  --- |
| send_time | GET | 2012-07-14 23:32:36 | Zorunlu Değil |

Örnek Sonuç:

    {
       "status":"success",
       "code":200,
       "message":"Transaction Successfuly!",
       "data":[
          {
             "id":1,
             "user_id":1,
             "number":"12094682430",
             "message":"Est rerum officia adipisci asperiores dolorem et. Sunt qui magnam qui. Enim ea laudantium qui deserunt est cum ducimus. Minus voluptatem natus rerum est dolorem.",
             "send_time":"2005-06-14 21:06:30",
             "status":0,
             "created_at":"2024-01-10T00:42:42.000000Z",
             "updated_at":"2024-01-10T00:42:42.000000Z",
             "user":{
                "id":1,
                "name":"Test",
                "email":"info@vatansoft.com",
                "email_verified_at":"2024-01-10T00:42:41.000000Z",
                "created_at":"2024-01-10T00:42:42.000000Z",
                "updated_at":"2024-01-10T00:42:42.000000Z"
             }
          },
          {
             "id":2,
             "user_id":1,
             "number":"15209652895",
             "message":"Ad consectetur optio ut nesciunt. Omnis error aspernatur vel molestiae deserunt sit. Aliquam et qui ut dolor dolores. Alias veritatis rerum accusantium labore ratione vitae.",
             "send_time":"1990-10-02 13:26:08",
             "status":0,
             "created_at":"2024-01-10T00:42:42.000000Z",
             "updated_at":"2024-01-10T00:42:42.000000Z",
             "user":{
                "id":1,
                "name":"Test",
                "email":"info@vatansoft.com",
                "email_verified_at":"2024-01-10T00:42:41.000000Z",
                "created_at":"2024-01-10T00:42:42.000000Z",
                "updated_at":"2024-01-10T00:42:42.000000Z"
             }
          }
       ]
    }

## 5. GET /api/sms/{id}
Gönderilen SMS isteğinin detayını verdiği servistir. sms id 'si istek de gönderilmesi zorunludur.

Örnek İstek:

| Sorgu Paramteresi | İstek Tipi | **Örnek Değer** | Zorunluluk |
| --- | --- | --- |  --- |
| id | GET | 1 | Zorunlu |

Sample Result:

    {
       "status":"success",
       "code":200,
       "message":"Transaction Successfuly!",
       "data":{
          "id":1,
          "user_id":1,
          "number":"12094682430",
          "message":"Est rerum officia adipisci asperiores dolorem et. Sunt qui magnam qui. Enim ea laudantium qui deserunt est cum ducimus. Minus voluptatem natus rerum est dolorem.",
          "send_time":"2005-06-14 21:06:30",
          "status":0,
          "created_at":"2024-01-10T00:42:42.000000Z",
          "updated_at":"2024-01-10T00:42:42.000000Z",
          "user":{
             "id":1,
             "name":"Test",
             "email":"info@vatansoft.com",
             "email_verified_at":"2024-01-10T00:42:41.000000Z",
             "created_at":"2024-01-10T00:42:42.000000Z",
             "updated_at":"2024-01-10T00:42:42.000000Z"
          }
       }
    }
