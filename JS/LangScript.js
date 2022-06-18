function setLang(langName)
{
    document.cookie = "lang="+langName;
    location = self.location;
}