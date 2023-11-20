## Installation


- composer install
- php artisan key:generate
- php artisan migrate:fresh --seed

---
- customer@demo.com
- password123


- admin@demo.com
- password123
---

**postman collection in main folder you can download and import in postman**


يوجد سكربت في ركوست ال login بيتولي طباعة ال token و بيحقنه في ال  global variables و كل الركوستات اللي محتاجه auth بتورث منه
طبعا فيه طرق كتير نهندل بيها ال multi auth  customer and admin  انا استخدمت ابسطهم و اللي هتقوم باللازم حسب المتطلات
