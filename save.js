function WriteToFile() {
  set fso = CreateObject("Scripting.FileSystemObject");
  set s = fso.CreateTextFile("/data/data.txt", True);
  s.writeline(document.getElementById("Score").value);
  s.Close();
}
