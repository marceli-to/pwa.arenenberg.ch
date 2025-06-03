/**
 * Audio Player Module
 * Automatically initializes for elements with data-audio-player attribute
 */
const AudioPlayer = (function() {
  class Player {
    constructor(element) {
      this.player = element;
      this.audioSrc = this.player.dataset.audioSrc;
      if (!this.audioSrc) {
        throw new Error('No audio source specified in data-audio-src attribute');
      }

      // Get control elements
      this.playBtn = this.player.querySelector('[data-audio-play]');
      this.pauseBtn = this.player.querySelector('[data-audio-pause]');
      this.rewindBtn = this.player.querySelector('[data-audio-rewind]');
      this.forwardBtn = this.player.querySelector('[data-audio-forward]');
      this.progressBar = this.player.querySelector('[data-audio-progress]');
      this.progressHandle = this.player.querySelector('[data-audio-handle]');
      this.progressContainer = this.player.querySelector('[data-audio-progress-container]');
      this.timeSpent = this.player.querySelector('[data-audio-time-spent]');
      this.timeRemaining = this.player.querySelector('[data-audio-time-remaining]');

      this.validateElements();

      this.audio = new Audio(this.audioSrc);
      this.rafId = null;

      this.bindMethods();
      this.initializeEventListeners();
      this.initializeState();
    }

    validateElements() {
      const requiredElements = {
        playBtn: '[data-audio-play]',
        pauseBtn: '[data-audio-pause]',
        rewindBtn: '[data-audio-rewind]',
        forwardBtn: '[data-audio-forward]',
        progressBar: '[data-audio-progress]',
        progressHandle: '[data-audio-handle]',
        progressContainer: '[data-audio-progress-container]',
        timeSpent: '[data-audio-time-spent]',
        timeRemaining: '[data-audio-time-remaining]'
      };
      for (const [key, selector] of Object.entries(requiredElements)) {
        if (!this[key]) {
          throw new Error(`Required element "${selector}" not found in audio player`);
        }
      }
    }

    bindMethods() {
      this.play = this.play.bind(this);
      this.pause = this.pause.bind(this);
      this.updateProgress = this.updateProgress.bind(this);
      this.seek = this.seek.bind(this);
      this.setProgress = this.setProgress.bind(this);
      this.startUpdatingProgress = this.startUpdatingProgress.bind(this);
      this.stopUpdatingProgress = this.stopUpdatingProgress.bind(this);
    }

    initializeState() {
      this.progressBar.style.width = '0%';
      this.progressHandle.style.left = '0%';
    }

    play() {
      this.playBtn.classList.add('hidden');
      this.pauseBtn.classList.remove('hidden');
      this.audio.play().catch(error => {
        console.error('Error playing audio:', error);
      });
      this.startUpdatingProgress();
    }

    pause() {
      this.pauseBtn.classList.add('hidden');
      this.playBtn.classList.remove('hidden');
      this.audio.pause();
      this.stopUpdatingProgress();
    }

    startUpdatingProgress() {
      const step = () => {
        this.updateProgress();
        this.rafId = requestAnimationFrame(step);
      };
      this.rafId = requestAnimationFrame(step);
    }

    stopUpdatingProgress() {
      if (this.rafId) {
        cancelAnimationFrame(this.rafId);
        this.rafId = null;
      }
    }

    updateProgress() {
      if (!this.audio.duration) return;

      const percent = (this.audio.currentTime / this.audio.duration) * 100;
      this.progressBar.style.width = `${percent}%`;

      if (percent < 98) {
        this.progressHandle.style.left = `${percent}%`;
      }

      const timeRemaining = this.audio.duration - this.audio.currentTime;
      this.timeRemaining.textContent = `-${this.formatTime(timeRemaining)}`;

      const timeSpent = this.audio.currentTime;
      this.timeSpent.textContent = this.formatTime(timeSpent);
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
      this.audio.addEventListener('loadedmetadata', () => {
        this.timeSpent.textContent = this.formatTime(0);
        this.timeRemaining.textContent = `-${this.formatTime(this.audio.duration)}`;
      });

      this.audio.addEventListener('ended', () => {
        this.pause();
        this.audio.currentTime = 0;
        this.updateProgress();
      });

      let isDragging = false;

      const onTouchMove = (e) => {
        if (!isDragging || !e.touches.length) return;
        this.setProgress(e.touches[0]);
      };
    
      const onTouchEnd = () => {
        if (isDragging) {
          isDragging = false;
          this.startUpdatingProgress(); // resume updates
        }
      };
    
      this.progressContainer.addEventListener('touchstart', (e) => {
        if (!e.touches.length) return;
        e.preventDefault();
        isDragging = true;
        this.stopUpdatingProgress(); // pause updates
        this.setProgress(e.touches[0]);
      }, { passive: false });
    
      document.addEventListener('touchmove', onTouchMove);
      document.addEventListener('touchend', onTouchEnd);
      

      this.playBtn.addEventListener('click', this.play);
      this.pauseBtn.addEventListener('click', this.pause);
      this.rewindBtn.addEventListener('click', () => this.seek(-15));
      this.forwardBtn.addEventListener('click', () => this.seek(15));
      this.progressContainer.addEventListener('click', this.setProgress);

      this.player.audioPlayer = this;

      document.addEventListener('keydown', (e) => {
        if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') return;

        switch (e.code) {
          case 'Space':
            e.preventDefault();
            if (this.audio.paused) {
              this.play();
            } else {
              this.pause();
            }
            break;
          case 'ArrowLeft':
            this.seek(-15);
            break;
          case 'ArrowRight':
            this.seek(15);
            break;
        }
      });
    }
  }

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

  document.addEventListener('DOMContentLoaded', function() {
    init();
  });

  return {};
})();
