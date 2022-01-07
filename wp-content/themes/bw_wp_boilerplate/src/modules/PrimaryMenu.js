class PrimaryMenu{
  constructor( ) {
    this.primaryMenu = document.querySelector( '#primary-menu' );
    this.events();
  }  
  
  events() {
    this.primaryMenu.addEventListener( 'click', e => {
      const toggler = document.querySelector( '.toggler' );
      // Close menu only when it doesn't have sub-menu
      if( !e.target.nextElementSibling ) {
        toggler.checked = false;
      }
    });
  }

}

export default PrimaryMenu;