#### ب. کلون کردن مخزن

پس از ایجاد مخزن در GitHub، اگر می‌خواهید آن را به سیستم محلی خود منتقل کنید، از دستور `git clone` استفاده کنید. این دستور به شما امکان می‌دهد تا یک کپی محلی از مخزن GitHub ایجاد کنید.

1.  **دریافت URL مخزن**: به صفحه مخزن در GitHub بروید و URL مربوط به آن را کپی کنید. شما می‌توانید از گزینه HTTPS یا SSH استفاده کنید.

    -   برای HTTPS، URL به صورت زیر خواهد بود:

  

         

        `https://github.com/your_username/your_repository.git`

    -   برای SSH، URL به صورت زیر خواهد بود:



         

        `git@github.com:your_username/your_repository.git`

2.  **استفاده از دستور کلون**: به ترمینال بروید و به پوشه‌ای که می‌خواهید مخزن را در آن کلون کنید بروید. سپس از دستور زیر استفاده کنید:

    bash

     

    `git clone https://github.com/your_username/your_repository.git`

    یا

    bash

     

    `git clone git@github.com:your_username/your_repository.git`

3.  **ورود به پوشه پروژه**: پس از اتمام کلون، با استفاده از دستور زیر به پوشه مخزن بروید:

    bash

     

    `cd your_repository`

### 5\. اضافه کردن فایل‌ها

فایل‌های پروژه خود را به پوشه مخزن کپی کنید. سپس برای اضافه کردن فایل‌ها به Git از دستور زیر استفاده کنید:

bash

 

`git add .`

(نقطه به معنای اضافه کردن همه فایل‌هاست.)

### 6\. ثبت تغییرات (Commit)

پس از اضافه کردن فایل‌ها، تغییرات را ثبت کنید:

bash

 

`git commit -m "Initial commit"`

متن داخل نقل قول بیانگر تغییراتی است که ایجاد کرده‌اید.

### 7\. ارسال تغییرات به GitHub

برای ارسال تغییرات محلی به مخزن GitHub از دستور زیر استفاده کنید:

bash

 

`git push origin main`

(اگر branch شما "main" نیست، نام branch خود را جایگزین کنید.)

### 8\. کار با تغییرات جدید

در صورتی که بخواهید تغییرات جدیدی را از GitHub دریافت کنید:

bash

 

`git pull origin main`

نکات مهم
--------

-   **برچسب‌ها (Branches)**: اگر بخواهید به صورت مجزا روی ویژگی‌های جدید کار کنید، می‌توانید از branch استفاده کنید.

    bash

     

    `git checkout -b new-feature`

-   **مرج کردن (Merging)**: پس از اتمام کار بر روی یک ویژگی جدید، می‌توانید آن را به branch اصلی (main) مرج کنید:

    bash

     

    `git checkout main
    git merge new-feature`

خلاصه
-----

-   **گام اول**: نصب Git و ایجاد حساب GitHub.
-   **گام دوم**: ایجاد یک مخزن جدید.
-   **گام سوم**: تنظیم Git در سیستم محلی.
-   **گام چهارم**: کلون کردن مخزن.
-   **گام پنجم**: اضافه کردن، ثبت و ارسال تغییرات به GitHub.


