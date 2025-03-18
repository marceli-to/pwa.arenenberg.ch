/**
 * Audio Player Module
 * Automatically initializes for elements with data-audio-player attribute
 */
const AudioPlayer = (function() {
  class Player {
    constructor(element) {
      // Store DOM element
      this.player = element;
      
      // Get audio source from data attribute
      this.audioSrc = this.player.dataset.audioSrc;
      if (!this.audioSrc) {
        throw new Error('No audio source specified in data-audio-src attribute');
      }
      // Initialize controls using data attributes
      this.playPauseBtn = this.player.querySelector('[data-audio-play]');
      this.rewindBtn = this.player.querySelector('[data-audio-rewind]');
      this.forwardBtn = this.player.querySelector('[data-audio-forward]');
      this.progressBar = this.player.querySelector('[data-audio-progress]');
      this.progressHandle = this.player.querySelector('[data-audio-handle]');
      this.progressContainer = this.player.querySelector('[data-audio-progress-container]');
      // Removed currentTimeEl
      this.timeLeftEl = this.player.querySelector('[data-audio-time-left]');
      // Validate required elements
      this.validateElements();
      // Initialize audio
      this.audio = new Audio(this.audioSrc);
      // Initialize
      this.bindMethods();
      this.initializeEventListeners();
      this.initializeState();
    }
    validateElements() {
      const requiredElements = {
        playPauseBtn: '[data-audio-play]',
        rewindBtn: '[data-audio-rewind]',
        forwardBtn: '[data-audio-forward]',
        progressBar: '[data-audio-progress]',
        progressHandle: '[data-audio-handle]',
        progressContainer: '[data-audio-progress-container]',
        timeLeftEl: '[data-audio-time-left]'
      };
      for (const [key, selector] of Object.entries(requiredElements)) {
        if (!this[key]) {
          throw new Error(`Required element "${selector}" not found in audio player`);
        }
      }
    }
    bindMethods() {
      this.togglePlayPause = this.togglePlayPause.bind(this);
      this.updateProgress = this.updateProgress.bind(this);
      this.seek = this.seek.bind(this);
      this.setProgress = this.setProgress.bind(this);
    }
    initializeState() {
      // Set initial states
      this.progressBar.style.width = '0%';
      this.progressHandle.style.left = '0%';
    }
    togglePlayPause() {
      if (this.audio.paused) {
        this.audio.play()
          .catch(error => {
            console.error('Error playing audio:', error);
          });
      } else {
        this.audio.pause();
      }
    }
    updateProgress() {
      if (!this.audio.duration) return;
      
      const percent = (this.audio.currentTime / this.audio.duration) * 100;
      this.progressBar.style.width = `${percent}%`;
      // do not update after 95%
      if (percent < 98) {
        this.progressHandle.style.left = `${percent}%`;
      }
      
      // Update time left display
      const timeLeft = this.audio.duration - this.audio.currentTime;
      this.timeLeftEl.textContent = this.formatTime(timeLeft);
    }
    formatTime(seconds) {
      const minutes = Math.floor(seconds / 60);
      const remainingSeconds = Math.floor(seconds % 60);
      return `${minutes}:${remainingSeconds.toString().padStart(2, '0')}`;
    }
    seek(seconds) {
      const newTime = Math.max(0, Math.min(this.audio.duration, this.audio.currentTime + seconds));
      if (isFinite(newTime)) {
        this.audio.currentTime = newTime;
      }
    }
    setProgress(e) {
      const bounds = this.progressContainer.getBoundingClientRect();
      const x = e.clientX - bounds.left;
      const percent = Math.min(Math.max(0, x / bounds.width), 1);
      if (isFinite(this.audio.duration)) {
        this.audio.currentTime = percent * this.audio.duration;
      }
    }
    initializeEventListeners() {
      // Audio events
      this.audio.addEventListener('loadedmetadata', () => {
        // Update the time left display
        this.timeLeftEl.textContent = this.formatTime(this.audio.duration);
      });
      this.audio.addEventListener('timeupdate', this.updateProgress);
      this.audio.addEventListener('ended', () => {
        // Just reset the audio when it ends
      });
      // Control events
      this.playPauseBtn.addEventListener('click', this.togglePlayPause);
      this.rewindBtn.addEventListener('click', () => this.seek(-15)); // Changed to 15 seconds
      this.forwardBtn.addEventListener('click', () => this.seek(15)); // Changed to 15 seconds
      // Progress bar click event
      this.progressContainer.addEventListener('click', this.setProgress.bind(this));
      // Store instance reference on the element
      this.player.audioPlayer = this;
      // Keyboard controls
      document.addEventListener('keydown', (e) => {
        if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') return;
        
        switch (e.code) {
          case 'Space':
            e.preventDefault();
            this.togglePlayPause();
            break;
          case 'ArrowLeft':
            this.seek(-15); // Changed to 15 seconds
            break;
          case 'ArrowRight':
            this.seek(15); // Changed to 15 seconds
            break;
        }
      });
    }
  }
  // Initialize function for a single player
  function init() {
    const playerElement = document.querySelector('[data-audio-player]');
    if (playerElement) {
      try {
        new Player(playerElement);
      } catch (error) {
        console.error(`Error initializing audio player:`, error);
      }
    }
  }
  // Listen for DOMContentLoaded and initialize the player if it exists
  document.addEventListener('DOMContentLoaded', function() {
    init();
  });
  // Return empty object - no public API needed
  return {};
})();