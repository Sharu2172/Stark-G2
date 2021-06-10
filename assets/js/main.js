function html2pdf() {
  const element = document.getElementById("main");
  html2pdf().from(element).save();
}
