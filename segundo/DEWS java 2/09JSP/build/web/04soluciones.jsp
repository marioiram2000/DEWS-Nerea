<%
    int a = Integer.parseInt(request.getParameter("a"));
    int b = Integer.parseInt(request.getParameter("b"));
    int c = Integer.parseInt(request.getParameter("c"));
    
    double x1  = (-b + Math.sqrt(b*b - 4*a*c))/(2*a);
    double x2  = (-b - Math.sqrt(b*b - 4*a*c))/(2*a);
    
    out.print("La ecuación "+a+"x2"+" + "+b+"x"+" + "+c+" = 0 ");
    out.print("x1 ="+x1+" y x2="+x2);
%>