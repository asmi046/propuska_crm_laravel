export default class SideMenu {
    constructor(menue_id, menue_activate_btn) {
        this.menue = document.querySelector(menue_id)
        this.menue_activate_buttons = document.querySelectorAll(menue_activate_btn);

        this.menue.querySelector('.shadow').addEventListener('click', () => {
            this.menue_toggle();
        })

        for (let i = 0; i < this.menue_activate_buttons.length; i++) {
            this.menue_activate_buttons[i].addEventListener('click', () => {
                this.menue_toggle();
            })
        }
    }

    menue_toggle() {
        this.menue.classList.toggle('active');
    }
}
