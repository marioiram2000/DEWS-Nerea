<%
  if(request.getAttribute("error")!=null){
      Exception e = (NumberFormatException)request.getAttribute("error");
      out.print("<p>"+e.getMessage()+" "+e.getLocalizedMessage()+"</p>");
  }  
%>