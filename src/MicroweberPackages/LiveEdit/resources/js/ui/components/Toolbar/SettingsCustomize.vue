<template>
    <div class="mw-live-edit-right-sidebar-wrapper mx-2">
        <span v-on:click="show('template-settings')" :class="[buttonIsActive?'live-edit-right-sidebar-active':'']"
              class="btn-icon live-edit-toolbar-buttons live-edit-toolbar-button-css-editor-toggle">
            <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" height="22" viewBox="0 96 960 960" width="22"><path
                d="M480 976q-82 0-155-31.5t-127.5-86Q143 804 111.5 731T80 576q0-83 32.5-156t88-127Q256 239 330 207.5T488 176q80 0 151 27.5t124.5 76q53.5 48.5 85 115T880 538q0 115-70 176.5T640 776h-74q-9 0-12.5 5t-3.5 11q0 12 15 34.5t15 51.5q0 50-27.5 74T480 976Zm0-400Zm-220 40q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm120-160q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm200 0q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm120 160q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17ZM480 896q9 0 14.5-5t5.5-13q0-14-15-33t-15-57q0-42 29-67t71-25h70q66 0 113-38.5T800 538q0-121-92.5-201.5T488 256q-136 0-232 93t-96 227q0 133 93.5 226.5T480 896Z"/></svg>
        </span>
    </div>
</template>


<script>
import CSSGUIService from "../../../api-core/services/services/css-gui.service.js";
import {PencilIcon, PlayIcon, CogIcon, LightBulbIcon} from '@heroicons/vue/outline'
import LayoutsIcon from "../Icons/LayoutsIcon.vue";
import ListIcon from "../Icons/ListIcon.vue";
import ModulesIcon from "../Icons/ModulesIcon.vue";
import DesignSettingsIcon from "../Icons/DesignSettingsIcon.vue";

export default {
    methods: {
        show: function (name) {

            this.emitter.emit('live-edit-ui-show', name);
        }
    },

    mounted() {

      mw.top().app.on('mw.open-template-settings', () => {
        // close the hamburger
        if(document.getElementById('user-menu-wrapper')) {
          document.getElementById('user-menu-wrapper').classList.remove('active');
        }


        this.show('template-settings')
      });


        let instance = this;
        this.emitter.on("live-edit-ui-show", show => {
            var isActiveButton = false

            if (show == 'template-settings') {
                isActiveButton = true;
            } else if (show == 'style-editor') {
                isActiveButton = true;
            }


            if (isActiveButton ) {
                instance.buttonIsActive = true;
                CSSGUIService.show()
            } else {
                instance.buttonIsActive = false;
                CSSGUIService.hide()
            }
        });
    },
    data() {
        return {
            buttonIsActive: false
        }
    }
}
</script>
