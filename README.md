# Aibel Builders Website

This is a static architectural portfolio website for Aibel Builders.

## Hosting on GitHub Pages

This project is configured to be hosted on GitHub Pages using GitHub Actions.

### Steps to set up:

1.  **Push to GitHub**: Ensure your project is pushed to a GitHub repository.
2.  **Enable GitHub Actions Deployment**:
    - Go to your repository on GitHub.
    - Click on **Settings** -> **Pages**.
    - Under **Build and deployment** > **Source**, select **GitHub Actions** from the dropdown menu.
3.  **Deploy**: The site will automatically deploy whenever you push changes to the `main` branch.

## Managing Projects (Admin CMS)

The website includes a built-in Admin CMS for managing project data.

### How to update project data:

1.  Open `index.html` in your local browser.
2.  Navigate to the **Projects** page.
3.  Scroll to a project and click **Edit Project**, or use the admin interface (if visible) to add a new one.
4.  After making your changes, click the **Export Data** button in the Admin Modal.
5.  This will download a file named `projects-data.js`.
6.  **Replace** the existing `projects-data.js` in your project folder with the downloaded one.
7.  Run the `1-Click-Upload.bat` script to push the changes to GitHub.

## Project Structure
- `index.html`: Home page
- `projects.html`: Portfolio page with dynamic loading
- `projects-data.js`: The source of truth for all project information
- `script.js`: Core logic for animations and CMS
- `style.css`: Modern, responsive styling
- `assets/`: Image assets and resources
