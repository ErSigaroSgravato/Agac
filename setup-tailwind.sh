#!/bin/bash

# === 1. Install Tailwind CSS and Vite plugin ===
echo "Installing Tailwind CSS and Vite plugin..."
npm install -D tailwindcss@latest @tailwindcss/vite

# === 2. Create Tailwind config file ===
echo "Creating tailwind.config.js..."
cat <<EOT > tailwind.config.js
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue"
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
EOT

# === 3. Remove or rename PostCSS config (to avoid errors) ===
if [ -f "postcss.config.js" ]; then
  echo "Renaming postcss.config.js to postcss.config.js.bak"
  mv postcss.config.js postcss.config.js.bak
fi

if [ -f "postcss.config.cjs" ]; then
  echo "Renaming postcss.config.cjs to postcss.config.cjs.bak"
  mv postcss.config.cjs postcss.config.cjs.bak
fi

# === 4. Update vite.config.js to use Tailwind plugin ===
echo "Updating vite.config.js..."
cat <<EOT > vite.config.js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwind from '@tailwindcss/vite';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
    tailwind(),
  ],
});
EOT

# === 5. Create Tailwind CSS file ===
mkdir -p resources/css
echo "Creating resources/css/app.css..."
cat <<EOT > resources/css/app.css
@tailwind base;
@tailwind components;
@tailwind utilities;
EOT

# === 6. Import CSS in JS entry file ===
mkdir -p resources/js
echo "Creating resources/js/app.js..."
cat <<EOT > resources/js/app.js
import './css/app.css';
EOT

# === Final Instructions ===
echo ""
echo "✅ Setup complete!"
echo ""
echo "Next steps:"
echo "1. Run 'npm run dev' to start the Vite dev server"
echo "2. Use Tailwind classes in your Blade files"
echo "3. Optionally run 'php artisan serve' in another terminal"