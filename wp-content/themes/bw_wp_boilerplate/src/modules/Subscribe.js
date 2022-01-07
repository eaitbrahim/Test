import axios from 'axios';

import FormValidator from './FormValidator';

class Subscribe {
  constructor() {
    this.subscribeForm = document.querySelector( '#subscribe-form' );
    
    if( this.subscribeForm ) {
      this.validator = new FormValidator( this.subscribeForm, [ 'email' ] );
      this.validator.initialize();
      //axios.defaults.headers.common['X-WP-Nonce'] = bwwpbpData.nonce;
      this.headers = {
        headers: { 
            'X-WP-Nonce': bwwpbpData.nonce,
            'Access-Control-Allow-Headers': 'Content-Type, X-WP-Nonce',
        }
    }
      this.events();
    }
  }

  events() {
    this.subscribeForm.addEventListener( 'submit', e => {
	    e.preventDefault();
      if ( this.validator.isValid() ) {
        const email = document.querySelector( `#email` );
        this.submitSubscription( email.value.trim() );
      }
    });
  }

  submitSubscription( email ) {
    const newSubscription = {
      'email': email
    }
    
    try {
      axios.post( `${ bwwpbpData.rest_url }bwwpbp/v1/subscription`, newSubscription, this.headers ).then( response => {
        document.querySelector( '.success-message' ).innerText = response.data;
        this.resetSubscription();
      } );
    } catch ( e ) {
      console.log ( 'An error occured while performing subscription: ', e );
    } 
  } 
  
  resetSubscription() {
    const emailInput = document.querySelector( `#email` );
    emailInput.value = '';
    const successIcon = emailInput.parentElement.querySelector( '.icon-success' );
    successIcon.classList.add( 'hidden' );
  }
}
export default Subscribe;