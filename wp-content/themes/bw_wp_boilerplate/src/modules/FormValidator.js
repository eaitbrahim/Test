class FormValidator {
  constructor( form, fields ) {
    this.form = form;
    this.fields = fields;
    this.valid = false;
  }  
  
  initialize() {
    this.validateOnEntry();
    this.validateOnSubmit();
  }
  
  isValid() {
    return this.valid;
  }

  validateOnSubmit() {
    let self = this;
    
    this.form.addEventListener( 'submit', e => {
	    e.preventDefault();
	    self.fields.forEach( field => {
        const input = document.querySelector( `#${ field }` );
        self.validateFields( input );
      });
    });
  }
  
  validateOnEntry() {
    let self = this;
    this.fields.forEach( field => {
      const input = document.querySelector( `#${ field }` );
      
      input.addEventListener( 'input', event => {
        self.validateFields( input );
      } );
    } );
  }
  
  validateFields( field ) {
    // Check presence of values
    if ( field.value.trim() === '' ) {
      this.setStatus( field, `${ field.id } cannot be blank`, 'error' );
      this.valid = false;
    } else {
      this.setStatus( field, null, 'success' );
      this.valid = true;
    }
    
    // check for a valid email address
    if ( field.type === 'email' ) {
      const re = /\S+@\S+\.\S+/;
      if ( re.test( field.value ) ) {
        this.setStatus( field, null, 'success' );
        this.valid = true;
      } else {
        this.setStatus( field, 'Please enter valid email address', 'error' );
        this.valid = false;
      }
    }
  }

  setStatus( field, message, status ) {
    const successIcon = field.parentElement.querySelector( '.icon-success' );
    const errorIcon = field.parentElement.querySelector( '.icon-error' );
    const errorMessage = field.parentElement.querySelector( '.error-message' );
    const successMessage = document.querySelector( '.success-message' );

    if ( status === 'success' ) {
      successMessage.classList.remove( 'hidden' );
      if ( errorIcon ) { 
        errorIcon.classList.add( 'hidden' );
      }
      if ( errorMessage ) { 
        errorMessage.innerText = '';
      }
      successIcon.classList.remove( 'hidden' );
      field.classList.remove( 'input-error' );
    } 
    
    if ( status === 'error' ) {
      successMessage.classList.add( 'hidden' );
      successMessage.innerText = '';
      if ( successIcon ) { 
        successIcon.classList.add( 'hidden' ); 
      }
      field.parentElement.querySelector( '.error-message' ).innerText = message;
      errorIcon.classList.remove( 'hidden' );
      field.classList.add( 'input-error' );
    }    
  }
}

export default FormValidator;