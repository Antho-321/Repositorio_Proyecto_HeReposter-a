const inputs = document.querySelectorAll('input[type="text"]');
inputs.forEach((input) => {
  input.addEventListener('input', () => {
    input.value = input.value.toUpperCase();
  });
});