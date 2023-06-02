

// Vuetify
import { createVuetify } from 'vuetify'

// Components
import { VBtn } from 'vuetify/components'

export default createVuetify({
    ssr: true,
    aliases: {
        VBtnAlt: VBtn,
    },
    // https://next.vuetifyjs.com/features/global-configuration/
    defaults: {
        global: {
            rounded: 'sm',
        },
        VAppBar: {
            flat: true,
        },
        VBtn: {
            color: 'primary',
            height: 44,
            minWidth: 190,
        },
        VBtnAlt: {
            color: 'primary',
            height: 48,
            minWidth: 190,
            variant: 'outlined',
        },
        VSheet: {
            color: '#212121',
        },
    },
    // https://next.vuetifyjs.com/features/theme/
    theme: {
        defaultTheme: 'light',
        dark: false,
        colors: {
            background: '#FFFFFF',
            surface: '#FFFFFF',
            primary: '#6200EE',
            'primary-darken-1': '#3700B3',
            secondary: '#03DAC6',
            'secondary-darken-1': '#018786',
            error: '#B00020',
            info: '#2196F3',
            success: '#4CAF50',
            warning: '#FB8C00',
        },
    },
})
