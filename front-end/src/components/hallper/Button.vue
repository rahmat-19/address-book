<template>
  <button :class="buttonClass" :disabled="disabled" @click="handleClick">
    <slot></slot>
  </button>
</template>

<script setup>
import { computed, defineProps, defineEmits } from "vue";

const props = defineProps({
  type: {
    type: String,
    default: "button",
  },
  disabled: {
    type: Boolean,
    default: false,
  },
  variant: {
    type: String,
    default: "primary", // bisa juga 'secondary', 'danger', dll.
    validator: (value) =>
      [
        "primary",
        "secondary",
        "danger",
        "gold",
        "transparant",
        "jade",
      ].includes(value),
  },
  size: {
    type: String,
    default: "medium", // bisa juga 'small', 'medium', 'large', dll.
    validator: (value) => ["small", "medium", "large"].includes(value),
  },
});

const emits = defineEmits(["click"]);

const buttonClass = computed(() => [
  "btn",
  `btn--${props.variant}`,
  `btn--${props.size}`,
]);

const handleClick = (event) => {
  emits("click", event);
};
</script>

<style scoped>
/* Gaya dasar tombol */
.btn {
  padding: 0.5em 1em;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 1em;
}

/* Variasi tombol */
.btn--primary {
  background-color: #2f2fd6;
  color: white;
}
.btn--secondary {
  background-color: gray;
  color: white;
}
.btn--danger {
  background-color: #d53c3c;
  color: white;
}
.btn--gold {
  background-color: #696700;
  color: white;
}
.btn--transparant {
  border: 1px solid black;
  color: black;
}
.btn--jade {
  background-color: #009879;
  color: white;
}

/* Variasi tombol on hover*/
.btn--primary:hover {
  background-color: #1919df;
  color: white;
}
.btn--secondary:hover {
  background-color: #4d4d4d;
  color: white;
}
.btn--danger:hover {
  background-color: #f61e1e;
  color: white;
}
.btn--gold:hover {
  background-color: #444300;
  color: white;
}
.btn--transparant:hover {
  border: 1px solid black;
  color: black;
}
.btn--jade:hover {
  background-color: #006551;
  color: white;
}

/* Ukuran tombol */
.btn--small {
  padding: 0.25em 0.5em;
  font-size: 0.875em;
}
.btn--medium {
  padding: 0.5em 1em;
  font-size: 1em;
}
.btn--large {
  padding: 0.75em 1.5em;
  font-size: 1.125em;
}

/* Keadaan tombol dinonaktifkan */
.btn:disabled {
  background-color: lightgray;
  cursor: not-allowed;
}
</style>
