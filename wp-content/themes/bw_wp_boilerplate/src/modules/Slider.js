class Slider {
  constructor() {  
    this.auto = true; 
    this.intervalTime = 5000;
    
    this.slides = document.querySelectorAll( '.testimonial' );
    this.slides[ 0 ].classList.add( 'current' );
    this.next = document.querySelector( '#next' );
    this.prev = document.querySelector( '#prev' );
    this.pause = document.querySelector( '#pause' );
    this.play = document.querySelector( '#play' );

    if ( this.auto ) {
      // Run next slide at interval time
      this.slideInterval = setInterval( () => this.nextSlide(), this.intervalTime );
    }
    this.events();
  }

  events() {
    this.next.addEventListener( 'click', e => {
      this.nextSlide();
      if ( this.auto ) {
        clearInterval( this.slideInterval );
        this.slideInterval = setInterval( this.nextSlide, this.intervalTime );
      }
    } );
    
    this.prev.addEventListener( 'click', e => {
      this.prevSlide();
      if ( this.auto ) {
        clearInterval( this.slideInterval );
        this.slideInterval = setInterval( this.nextSlide, this.intervalTime );
      }
    } );

    this.pause.addEventListener( 'click', e => {
      this.auto = false;
      clearInterval( this.slideInterval );
      this.play.classList.remove( 'inactif' );
      this.play.classList.add( 'actif' );
      this.pause.classList.add( 'inactif' );
      this.pause.classList.remove( 'actif' );
    } );

    this.play.addEventListener( 'click', e => {
      this.auto = true;
      this.slideInterval = setInterval( () => this.nextSlide(), this.intervalTime );
      this.pause.classList.remove( 'inactif' );
      this.pause.classList.add( 'actif' );
      this.play.classList.add( 'inactif' );
      this.play.classList.remove( 'actif' );
    } );
  }

  nextSlide() {
    // Get current class
    const current = document.querySelector( '.current' );
    // Remove current class
    current.classList.remove( 'current' );
    // Check for next slide
    if ( current.nextElementSibling ) {
      // Add current to next sibling
      current.nextElementSibling.classList.add( 'current' );
    } else {
      // Add current to start
      this.slides[ 0 ].classList.add( 'current' );
    }
  }
  
  prevSlide() {
    // Get current class
    const current = document.querySelector( '.current' );
    // Remove current class
    current.classList.remove( 'current' );
    // Check for prev slide
    if ( current.previousElementSibling ) {
      // Add current to prev sibling
      current.previousElementSibling.classList.add( 'current' );
    } else {
      // Add current to last
      this.slides[ this.slides.length - 1 ].classList.add( 'current' );
    }
  }
} 

export default Slider;