# 🎪 Adventure Land Rentals — Laravel Web Application

**Adventure Land Rentals** is a responsive, feature-rich Laravel-based web application designed to manage a catalog of inflatable rentals. It includes categorized product listings, detailed views, order tracking, role-based access control, and a whimsical front-end theme inspired by the joy of children's events.

---

## 📦 Key Features

- 🏷️ **Product Catalog** with categories: Playgrounds, Slides, Climbs, Ball Pits, and Packages  
- 🔍 **Product Details View** with images, dimensions, and custom themes  
- 🧑‍💼 **Admin Dashboard** to manage products, categories, and users  
- 👥 **Role-Based Access Control**:  
  - **Admin**: Full CRUD control and user management  
  - **Product Manager**: Can add/edit products, but no access to users  
- 📦 **Order Management** (placeholder, expandable)  
- 🎨 **Animated Front-End UI** with Bootstrap + custom illustrations  
- 🧁 **Gallery of Star Clients** and FAQs  
- 📱 **Responsive Design** for mobile/tablet/desktop  

---

## 👨‍🎓 Developed By

This project was created as a Final Web Development project by:

- **Espartero, Gem Rasty**  
- **Manio, Jessica**  
- **Placente, Yesa**  
- **Sanoy, Patrick Angelo**

---

## ⚙️ How to Run the Application

> 💡 This guide assumes Laravel, Composer, Node.js, and MySQL are already installed on your machine.

### 📁 1. Clone or Download the Project

Download from GitHub or Google Drive and extract it, or run:

```bash
git clone https://github.com/your-repo/adventure-land.git
cd adventure-land
```

### 📄 2. Configure `.env`

Copy the example file:

```bash
cp .env.example .env
```

Then update the following lines to match your local database setup:

```ini
DB_DATABASE=adventure_land_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

Make sure the database `adventure_land_db` exists in your MySQL server.

### 📥 3. Install Dependencies

```bash
composer install
npm install
npm run dev
```

### 🔑 4. Generate App Key

```bash
php artisan key:generate
```

### 🧬 5. Migrate and Seed Database

```bash
php artisan migrate --seed
```

This will set up the tables and populate:

- Initial categories  
- Sample products  
- Admin and product manager users

### 🚀 6. Run the Server

```bash
php artisan serve
```

Then open in your browser:

```
http://127.0.0.1:8000
```

---

## 🔐 Default Accounts

| Role            | Email               | Password  |
|-----------------|---------------------|-----------|
| Admin           | admin@example.com   | password  |
| Product Manager | manager@example.com | password  |

You can log in and test the role-based restrictions in the admin dashboard.

---

## 🖼️ Image & Asset Paths

All product and UI images are stored in:

```
public/images/
├── playgrounds/
├── slides/
├── climbs/
├── ball_pits/
├── package/
│   ├── simple/
│   └── detailed/
├── btnBackArrow.png
├── btnNextArrow.png
├── icoLocation.png
├── icoFacebook.png
├── icoInstagram.png
├── imgViewRentalsHeader.png
```

Make sure all images are in the correct folders for proper rendering.

---

## 🌟 Pages Overview

- `/` - Animated Landing Page with Menu Overlay  
- `/aboutus` - About the team and mission  
- `/faqs` - Common questions  
- `/contactus` - Contact info and location  
- `/products` - Browse by category  
- `/products/{id}` - View detailed product info  
- `/admin` - Admin Panel (secured by role middleware)  

---

## 🧪 Testing & Validation

- ✅ **Functional Testing**: CRUD tested on products and categories via Admin Panel. All form submissions validate required fields with Laravel validation.  
- 🔒 **RBAC Testing**: Verified that Product Managers cannot access user/admin routes. Admin has access to full management tools.  
- 👤 **Usability Testing**: Conducted walkthroughs with non-developer users. Ensured visual consistency and readability on different screen sizes.  
- ⚠️ **Error Handling**: All forms include error display using Laravel's `@error`. 404 pages shown for invalid routes. Database constraint errors gracefully handled.  

---

## 🚧 Known Limitations

- No customer login or real-time order placement yet  
- No payment integration  
- Order tracking system is a placeholder and non-interactive  

---

## 🚀 Future Enhancements

- ✅ Booking calendar view for product availability  
- ✅ Customer portal with login and order history  
- ✅ Payment integration (GCash, PayPal)  
- ✅ Real-time order status updates  
- ✅ Admin dashboard analytics (product popularity, revenue, etc.)  

---

## 📜 License

This project was built for academic purposes only and is not intended for commercial deployment. All rights reserved ©️ 2025 by the developers.

Thanks for checking out Adventure Land Rentals! 🏰🌤️  
Feel free to customize and expand on this joyful Laravel application.
