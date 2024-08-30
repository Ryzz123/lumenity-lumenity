import { defineConfig } from 'vite'
import path from 'path'

/**
 * Vite's configuration file.
 * This configuration is used by Vite to handle the build process of the application.
 * It includes settings for the output directory, rollup options, resolve alias, and CSS postcss plugins.
 */
export default defineConfig({
    build: {
        /**
         * The directory to output the built assets.
         * The 'public' directory is used as the output directory.
         */
        outDir: 'public',

        /**
         * Whether to empty the output directory before building.
         * The output directory is not emptied before building.
         */
        emptyOutDir: false,

        rollupOptions: {
            /**
             * The entry points for the application.
             * The 'main' entry point is the 'app.js' file in the 'resources/js' directory.
             * The 'style' entry point is the 'app.css' file in the 'resources/css' directory.
             */
            input: {
                main: path.resolve(__dirname, 'resources/js/app.js'),
                style: path.resolve(__dirname, 'resources/css/app.css'),
            },

            output: {
                /**
                 * The file name for the 'main' entry point in the output directory.
                 * The 'main' entry point is output as 'js/app.js'.
                 */
                entryFileNames: 'js/app.js',

                /**
                 * The file name format for the assets in the output directory.
                 * The assets are output with the file name 'css/app.[ext]', where '[ext]' is the file extension.
                 */
                assetFileNames: 'css/app.[ext]',
            },
        },
    },

    resolve: {
        /**
         * The alias for the 'resources' directory.
         * The '@' symbol is used as the alias for the 'resources' directory.
         */
        alias: {
            '@': path.resolve(__dirname, 'resources'),
        },
    },

    css: {
        postcss: {
            /**
             * The PostCSS plugins used by Vite.
             * The 'tailwindcss' and 'autoprefixer' plugins are used.
             */
            plugins: [
                require('tailwindcss'),
                require('autoprefixer'),
            ],
        },
    },
})