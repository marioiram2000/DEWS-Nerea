<%
    String stra = request.getParameter("a");
    String strb = request.getParameter("b");
    String strc = request.getParameter("c");
    String error = request.getParameter("error");
    out.print("La ecuación "+stra+"x2"+" + "+strb+"x"+" + "+strc+" = 0 "+error);
%>