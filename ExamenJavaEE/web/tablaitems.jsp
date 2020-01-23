<%-- 
    Document   : tablaitems.jsp
    Created on : 23-ene-2020, 11:22:42
    Author     : dw2_alum4
--%>
<%@page import="beans.Item"%>
<%@page import="java.util.Iterator"%>
<%@page import="java.util.HashSet"%>

<%
HashSet hs = (HashSet)session.getAttribute("itemsPorPrecio");
if(hs!=null){
    
%>
  <h1>Items</h1>  
<%
  for (Iterator iterator = hs.iterator(); iterator.hasNext();) {
    Item it = (Item)iterator.next();
    //System.out.println("--------------------------ITEM"+it);
    %><a href='selectItems.jsp?item=<% out.print(it.getId()); %>'><%out.print(it.getNombre());%></a><br><%
        
        if(request.getParameter("item")!=null){
            
            if(request.getParameter("item").equals(it.getId()+"")){
    //System.out.println("HHHHHHHHHHHHHHHOOOOOOOOOOOOOOOOOOOLLLLLLLLLLLLLLLLLLAAAAAAAAAAAAAAA");
    %>
            
            <h3>Precio <%out.print(it.getPrecio());%></h3>
            <h3>Compradores: <%out.print(it.getCompradoresItem().size());%></h3>
            <ul>
                <%
                    System.out.println(it.getCompradoresItem());
                    for (Iterator<String> iter = it.getCompradoresItem().iterator(); iter.hasNext();) {
                        String comprador = iter.next();%>
                        <li><% out.print(comprador); %></li>
                    <%}
                    %>
            </ul>
            <%}
        }
    }
}else{
    //System.out.println("---------------------HS ES NULLLLL");
}

%>