<template>
  
  <div class="flex space-x-2">
    <!-- Generate OTP input fields dynamically based on the number of digits required -->
    <input
      v-for="(digit, index) in otpDigits"
      :key="index"
      type="text"
      maxlength="1"
      class="otp-input w-10"
      v-model="otpValues[index]"
      @input="handleInput($event, index)"
      ref="otpInputs"
    />
  </div>
</template>

<script setup>
import { ref, nextTick } from 'vue';

const otpDigits = 6; // Number of OTP digits
const otpValues = ref(Array(otpDigits).fill(''));

const otpInputs = ref([]);

function handleInput(event, index) {
  const value = event.target.value;

  if (value.length === 1) {
    // Move focus to the next input
    if (index < otpDigits - 1) {
      nextTick(() => {
        otpInputs.value[index + 1]?.focus();
      });
    }
  } else if (value.length === 0) {
    // Move focus to the previous input if the value is deleted
    if (index > 0) {
      nextTick(() => {
        otpInputs.value[index - 1]?.focus();
      });
    }
  }
  console.log({otpValues})
}
</script>

<style>
.otp-input {
  width: 2rem;
  height: 2rem;
  text-align: center;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 1.5rem;
}
</style>
