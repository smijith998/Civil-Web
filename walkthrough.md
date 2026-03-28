# Aibel Builders – WordPress Theme Setup Guide

The WordPress theme is ready in your project folder at:

**`Civil-Web/aibel-builders-theme/`**

---

## What Was Built

| File | Purpose |
|---|---|
| [style.css](file:///c:/Users/SMIJITH/OneDrive/Civil-Web/Civil-Web/style.css) | Theme declaration + all original styles |
| [functions.php](file:///c:/Users/SMIJITH/OneDrive/Civil-Web/Civil-Web/aibel-builders-theme/functions.php) | CPTs, meta boxes, asset loading |
| [header.php](file:///c:/Users/SMIJITH/OneDrive/Civil-Web/Civil-Web/aibel-builders-theme/header.php) | Nav + top bar (shared) |
| [footer.php](file:///c:/Users/SMIJITH/OneDrive/Civil-Web/Civil-Web/aibel-builders-theme/footer.php) | Footer (shared) |
| [front-page.php](file:///c:/Users/SMIJITH/OneDrive/Civil-Web/Civil-Web/aibel-builders-theme/front-page.php) | Home page |
| [page-projects.php](file:///c:/Users/SMIJITH/OneDrive/Civil-Web/Civil-Web/aibel-builders-theme/page-projects.php) | Projects (dynamic, from WP admin) |
| [page-gallery.php](file:///c:/Users/SMIJITH/OneDrive/Civil-Web/Civil-Web/aibel-builders-theme/page-gallery.php) | Gallery (auto-pulls project images) |
| [page-careers.php](file:///c:/Users/SMIJITH/OneDrive/Civil-Web/Civil-Web/aibel-builders-theme/page-careers.php) | Careers (dynamic job listings) |
| [page-about.php](file:///c:/Users/SMIJITH/OneDrive/Civil-Web/Civil-Web/aibel-builders-theme/page-about.php) | About page |
| [page-contact.php](file:///c:/Users/SMIJITH/OneDrive/Civil-Web/Civil-Web/aibel-builders-theme/page-contact.php) | Contact + Formspree form |
| [js/script.js](file:///c:/Users/SMIJITH/OneDrive/Civil-Web/Civil-Web/aibel-builders-theme/js/script.js) | Scroll, nav, animations |
| [assets/](file:///c:/Users/SMIJITH/OneDrive/Civil-Web/Civil-Web/aibel-builders-theme/functions.php#11-25) | Hero + project images |

---

## Step 1 – Install WordPress Locally

1. Download and install **[LocalWP (free)](https://localwp.com/)**
2. Create a new site → choose any name (e.g. `aibel-builders`)
3. Click **Open Site** → it opens your browser at `http://aibel-builders.local`

---

## Step 2 – Upload the Theme

1. In LocalWP, right-click the site → **Open Site Folder**
2. Navigate to `app → public → wp-content → themes`
3. **Copy the entire `aibel-builders-theme/` folder** into that `themes/` directory

---

## Step 3 – Activate the Theme

1. Go to **WordPress Admin** → `http://aibel-builders.local/wp-admin`
2. Navigate to **Appearance → Themes**
3. Find **Aibel Builders** and click **Activate**

---

## Step 4 – Create the 6 Pages

Go to **Pages → Add New** and create these pages in order:

| Page Title | Page Template to Select |
|---|---|
| `Home` | *(no template needed – set as static front page)* |
| `About` | **About** |
| [Projects](file:///c:/Users/SMIJITH/OneDrive/Civil-Web/Civil-Web/script.js#142-159) | **Projects** |
| [Gallery](file:///c:/Users/SMIJITH/OneDrive/Civil-Web/Civil-Web/gallery.html#205-249) | **Gallery** |
| `Careers` | **Careers** |
| `Contact` | **Contact** |

> **Set the front page**: Go to **Settings → Reading → Your homepage displays → A static page** → Set **Homepage** to `Home`.

---

## Step 5 – Add Your First Project (Admin Demo)

1. Go to **Projects → Add New** (in the left sidebar)
2. Fill in:
   - **Title**: e.g. `Biju Angamali | 3080 sqft`
   - **Category**: `Residential`
   - **Year**: `2025`
   - **Description**: Your project description
   - **Status**: `Completed` or `Upcoming`
   - **Gallery Images**: Click **Upload Images** → select your project photos
3. Click **Publish**

✅ The project now appears on the **Projects** page and its images appear on the **Gallery** page automatically.

---

## Step 6 – Add a Career Listing

1. Go to **Careers → Add New**
2. Fill in:
   - **Title**: e.g. `Senior Lead Architect`
   - **Location**: `Thrissur / Remote`
   - **Type**: `Full-time`
   - **Apply Link**: `https://...` or `mailto:aibeldibin@gmail.com`
3. Click **Publish**

✅ The job listing appears on the **Careers** page with an **Apply Now** button.

---

## How the Admin Workflow Works

```
Admin Dashboard
├── Projects → Add / Edit / Delete projects
│   ├── Set status: Completed or Upcoming
│   ├── Upload multiple gallery images (via WP media library)
│   └── Changes appear instantly on Projects + Gallery pages
│
└── Careers → Add / Edit / Delete job listings
    ├── Set location, employment type, description
    └── Add custom apply link per job
```

> [!NOTE]
> The **Gallery page is fully automatic** — it groups images by project name, pulled directly from whatever images you upload to each project. No separate gallery management needed.

---

## Deploying to a Live Server

When you're ready to go live:
1. Purchase any WordPress hosting (e.g. Hostinger, SiteGround, WP Engine)
2. Install WordPress on your hosting
3. Upload the `aibel-builders-theme/` folder to `wp-content/themes/` via FTP or cPanel File Manager
4. Repeat Steps 3–6 above on the live site
