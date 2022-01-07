class Search {
  constructor() {
    this.openButton = document.querySelectorAll( '.js-search-trigger' );
    this.searchField = document.querySelector( '.js-search-input' );
    this.events();
  }

  events() {
    this.openButton.forEach( el => {
      el.addEventListener( 'click', e => {
        e.preventDefault();
        this.toggleSearchField();
      } );
    } );
  }
    
  toggleSearchField() {
    this.searchField.classList.toggle( 'show' );
    this.searchField.value = '';
    setTimeout( () => this.searchField.focus(), 301 );
  }
}

export default Search;