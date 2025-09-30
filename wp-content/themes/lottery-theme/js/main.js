(function () {
	"use strict";

	function getHtmlEl() {
		return document.documentElement;
	}

	function getStoredTheme() {
		try {
			return localStorage.getItem("lottery-theme");
		} catch (e) {
			return null;
		}
	}

	function storeTheme(mode) {
		try {
			localStorage.setItem("lottery-theme", mode);
		} catch (e) {}
	}

	function applyTheme(mode) {
		const html = getHtmlEl();
		if (!html) return;
		if (mode === "dark") {
			html.setAttribute("data-theme", "dark");
		} else {
			html.removeAttribute("data-theme");
		}
		const btn = document.getElementById("lottery-dark-toggle");
		if (btn) {
			btn.textContent = mode === "dark"
				? (window.lotteryTheme && lotteryTheme.darkOff) || "Light"
				: (window.lotteryTheme && lotteryTheme.darkOn) || "Dark";
		}
	}

	function initTheme() {
		const stored = getStoredTheme();
		const prefersDark = window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches;
		const mode = stored || (prefersDark ? "dark" : "light");
		applyTheme(mode);
	}

	function toggleTheme() {
		const html = getHtmlEl();
		const isDark = html && html.getAttribute("data-theme") === "dark";
		const next = isDark ? "light" : "dark";
		applyTheme(next);
		storeTheme(next);
	}

	function handleCopyButtons() {
		const buttons = document.querySelectorAll(".lottery-referral__copy");
		if (!buttons || !buttons.length) return;
		buttons.forEach(function (btn) {
			btn.addEventListener("click", function () {
				const targetSel = btn.getAttribute("data-target");
				if (!targetSel) return;
				const input = document.querySelector(targetSel);
				if (!input) return;
				input.select();
				input.setSelectionRange(0, 99999);
				try {
					const ok = document.execCommand("copy");
					if (ok) {
						const orig = btn.textContent;
						btn.textContent = (window.lotteryTheme && lotteryTheme.copiedLabel) || "Copied!";
						setTimeout(function () {
							btn.textContent = orig || ((window.lotteryTheme && lotteryTheme.copyLabel) || "Copy");
						}, 1200);
					}
				} catch (e) {}
			});
		});
	}

	document.addEventListener("DOMContentLoaded", function () {
		initTheme();

		var toggle = document.getElementById("lottery-dark-toggle");
		if (toggle) {
			toggle.addEventListener("click", toggleTheme);
		}

		handleCopyButtons();

		if (window.matchMedia) {
			try {
				window.matchMedia("(prefers-color-scheme: dark)").addEventListener("change", function (e) {
					const stored = getStoredTheme();
					if (!stored) {
						applyTheme(e.matches ? "dark" : "light");
					}
				});
			} catch (e) {}
		}
	});
})();

