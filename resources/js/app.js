import "./bootstrap";
import.meta.glob(["../images/**", "../fonts/**"]);

import Alpine from "alpinejs";
import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";

window.Alpine = Alpine;

Alpine.start();
