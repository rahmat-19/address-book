import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import { env } from "vite-plugin-env";

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    vue(),
    env({
      dotenv: ".env",
    }),
  ],
  server: {
    port: 3000,
  },
});
