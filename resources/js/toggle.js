import $ from "jquery";

$(document).ready(function () {
  const trigger = document.querySelector(".js-toggle__trigger");
  const target = document.querySelector(".js-toggle__target");

  if (trigger && target) {
    // クリック時に履歴を消すための処理
    trigger.addEventListener("click", (event) => {
      event.preventDefault(); // デフォルトの履歴表示を防止
      target.classList.toggle("open");
    });

    // クリックを外した時に "open" クラスを外す
    document.addEventListener("click", (event) => {
      // trigger または target の外側をクリックした場合
      if (!trigger.contains(event.target) && !target.contains(event.target)) {
        target.classList.remove("open");
      }
    });
  }
});
