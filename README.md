# AZ's WP SMTP Mailer

A lightweight WordPress plugin to configure custom SMTP settings for sending emails reliably via your chosen mail server.

## Why I Created This Plugin?

Most SMTP plugins available today are packed with features I didn’t need — and many of them collect usage data or add unnecessary bloat.

**AZ's WP SMTP Mailer** was built with a single goal:  
Just send emails, simply and reliably — with no extra fluff.

- No tracking
- No upsells
- No over-engineered dashboards

If you're looking for a lightweight SMTP solution that just works, this is it.

---

## ✉️ Features

- Set custom SMTP host, port, encryption, and authentication

---

## 🔧 Installation

1. Download the latest release:  
   [Releases Page »](https://github.com/arisdla/azwp-mailer/releases)

2. Upload the `azwp-mailer.zip` file in your WordPress dashboard:  
   `Plugins → Add New → Upload Plugin`

3. Activate the plugin

---

## ⚙️ Configuration

After activation, go to:  
`Settings → Mailer Settings`  
to enter your SMTP settings.

---

## 🚀 Updates

This plugin uses a custom update mechanism powered by [plugin-update-checker](https://github.com/YahnisElsts/plugin-update-checker).  

It will automatically check for updates hosted on GitHub and notify you in your WordPress dashboard.

---

## 📁 Development

Clone the repo and work in the `azwp-mailer/` directory.

```bash
git clone https://github.com/arisdla/azwp-mailer.git
cd azwp-mailer
```

## 🐳 Use Docker for Local Development

**🛠 Requirements**

- Docker
- Docker Compose

### 📦 Setup Instructions

1. **Clone the repository** (if you haven’t already):

```bash
git clone https://github.com/arisdla/azwp-mailer.git
```

2. **Copy the .env template and customize**:

```bash
cp .env.example .env
```

```env example file
WORDPRESS_DB_NAME=change-me
WORDPRESS_DB_USER=change-me
WORDPRESS_DB_PASSWORD=change-me
MYSQL_ROOT_PASSWORD=change-me
AUTO_RESTART=no
```

3. **Start the containers**:

```bash
docker-compose up
```

This will start:

- WordPress at [http://localhost:8000](http://localhost:8000)
- phpMyAdmin at [http://localhost:8080](http://localhost:8080)

Volumes:

- ./`_wordpress`:/var/www/html
- ./`_db-data`:/var/lib/mysql
- ./`azwp-mailer`:/var/www/html/wp-content/plugins/azwp-mailer
