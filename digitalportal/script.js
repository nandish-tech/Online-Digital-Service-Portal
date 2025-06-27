<script>
  const reasonSelect = document.getElementById('reason-select');
  const customReasonLabel = document.getElementById('custom-reason-label');
  const customReasonInput = document.getElementById('custom-reason');

  reasonSelect.addEventListener('change', function () {
    if (this.value === 'Other') {
      customReasonLabel.style.display = 'block';
      customReasonInput.style.display = 'block';
      customReasonInput.setAttribute('name', 'custom-reason');
      customReasonInput.required = true;
    } else {
      customReasonLabel.style.display = 'none';
      customReasonInput.style.display = 'none';
      customReasonInput.removeAttribute('name');
      customReasonInput.required = false;
    }
  });
</script>