import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { resolve } from 'path';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
  
  resolve: {
    alias: {
      img: resolve('resources/media'),
      fonts: resolve('resources/fonts'),
      vue: 'vue/dist/vue.esm-bundler.js',
    }
  },
  server: {
    cors: true,
    headers: {
      'Access-Control-Allow-Origin': 'https://pwa.arenenberg.ch.test'
    }
  },
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
      },
    }),
  ],
  build: {
    rollupOptions: {
      input: {
        app: 'resources/js/app.js',
        css: 'resources/css/app.css',
      },
      output: {
        entryFileNames: 'assets/[name].js',
        chunkFileNames: 'assets/[name].js',
        assetFileNames: 'assets/[name].[ext]'
      }
    }
  },
  define: {
    'process.env': {},
  }
});
