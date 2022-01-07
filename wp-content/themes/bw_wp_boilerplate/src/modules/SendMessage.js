import axios from 'axios';

import FormValidator from './FormValidator';

class SendMessage {
  constructor() {
    this.messageForm = document.querySelector( '#message-form' );
    
    if( this.messageForm ) {
      this.validator = new FormValidator( this.messageForm, [ 'name', 'email-message', 'message' ] );
      this.validator.initialize();
      axios.defaults.headers.common[ 'X-WP-Nonce' ] = bwwpbpData.nonce;
      this.events();
    }
  }

  events() {
    this.messageForm.addEventListener( 'submit', e => {
	    e.preventDefault();
      if( this.validator.isValid() ) {
        const newMessage = {
          name: document.querySelector( `#name` ).value.trim(),
          email: document.querySelector( `#email-message` ).value.trim(),
          message: document.querySelector( `#message` ).value.trim(),
        };
        this.submitMessage( newMessage );
      }
    });
  }

  submitMessage( newMessage ) {
    try{
      axios.post( `${ bwwpbpData.rest_url }bwwpbp/v1/message`, newMessage ).then( response => {
        this.resetForm();
        document.querySelector( '.success-message--send-message' ).innerText = response.data;
      });
    } catch ( e ) {
      console.error( 'Error: ', e );
    }
  }  

  resetForm() {
    const emailInput = document.querySelector( `#email-message` );
    const nameInput = document.querySelector( `#name` );
    const messageInput = document.querySelector( `#message` );

    emailInput.value = '';
    let successIcon = emailInput.parentElement.querySelector( '.icon-success' );
    successIcon.classList.add( 'hidden' );
    
    nameInput.value = '';
    successIcon = nameInput.parentElement.querySelector( '.icon-success' );
    successIcon.classList.add( 'hidden' );
    
    messageInput.value = '';
    successIcon = messageInput.parentElement.querySelector( '.icon-success' );
    successIcon.classList.add( 'hidden' );
  }
}
export default SendMessage;