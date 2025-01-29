import $ from "jquery";

$(document).ready(function () {
    const triggers = document.querySelectorAll(".js-accordion");

    if (triggers.length === 0) return;

    function accordionToggle(event) {
        const trigger = event.currentTarget; // クリックされたトリガー
        const content = document.querySelector(".js-accordion-target"); // `.js-accordion-target` を取得

        if (!content) return; // 要素が存在しない場合は処理を終了

        if (content.style.display === "block") {
            content.style.display = "none"; // 閉じる
            trigger.classList.remove("open"); // クラスを削除
        } else {
            content.style.display = "block"; // 開く
            trigger.classList.add("open"); // クラスを追加
        }
    }

    triggers.forEach(trigger => {
        trigger.addEventListener("click", accordionToggle);
    });
});
