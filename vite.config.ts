import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';
import { storagePlugin } from './server/storagePlugin';

export default defineConfig({
  plugins: [react(), storagePlugin()],
  server: {
    port: 3000,
    host: true,
    watch: {
      ignored: [
        '**/*.mp4',
        '**/*.png',
        '**/*.jpg',
        '**/*.jpeg',
        '**/*.webp',
        '**/dist/**',
        '**/server/data/**',
      ],
    },
  },
});

