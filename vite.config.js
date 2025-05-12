import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import { resolve } from 'path';
import vue from '@vitejs/plugin-vue';

export default defineConfig(({ mode }) => {
  const env = loadEnv(mode, process.cwd(), '');
  console.log(env.ASSET_VERSION);

  return {
    resolve: {
      alias: {
        img: resolve('resources/media'),
        fonts: resolve('resources/fonts'),
        vue: 'vue/dist/vue.esm-bundler.js',
        '@': resolve('resources/js/spa'),
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
        input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/spa.js'],
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
          entryFileNames: `assets/[name]-${env.ASSET_VERSION}.js`,
          chunkFileNames: `assets/[name]-${env.ASSET_VERSION}.js`,
          assetFileNames: `assets/[name]-${env.ASSET_VERSION}.[ext]`
        }
      }
    },
    define: {
      'process.env.ASSET_VERSION': JSON.stringify(env.ASSET_VERSION || 'dev'),
    }
  };
});
