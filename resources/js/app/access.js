document.addEventListener('DOMContentLoaded', function() {
  const inputs = document.querySelectorAll('[data-access-input]');
  const form = document.querySelector('[data-access-form]');

  // Return if no inputs or form
  if (!inputs || !form) {
    return;
  }
  
  // Focus first input on page load
  inputs[0].focus();
  
  // Handle input events
  inputs.forEach((input, index) => {
    // Only allow single digit
    input.addEventListener('input', function() {
      if (this.value.length > 1) {
        this.value = this.value.slice(0, 1);
      }
      
      // Auto-move to next input
      if (this.value.length === 1 && index < inputs.length - 1) {
        inputs[index + 1].focus();
      }
    });
    
    // Handle backspace
    input.addEventListener('keydown', function(e) {
      if (e.key === 'Backspace' && this.value === '' && index > 0) {
        inputs[index - 1].focus();
      }
    });
  });
  
  // Handle form submission
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    const passcode = Array.from(inputs).map(input => input.value).join('');
    alert('Passcode entered: ' + passcode);
  });
});