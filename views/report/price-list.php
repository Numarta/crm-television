<?= '<?xml version="1.0"?>' ?>
<?= '<?mso-application progid="Excel.Sheet"?>' ?>
<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:html="http://www.w3.org/TR/REC-html40">
 <DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
  <Author>alexei</Author>
  <LastAuthor>alexei</LastAuthor>
  <Created>2016-05-08T19:19:48Z</Created>
  <LastSaved>2016-11-02T18:52:19Z</LastSaved>
  <Version>15.00</Version>
 </DocumentProperties>
 <OfficeDocumentSettings xmlns="urn:schemas-microsoft-com:office:office">
  <AllowPNG/>
 </OfficeDocumentSettings>
 <ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">
  <WindowHeight>9780</WindowHeight>
  <WindowWidth>21480</WindowWidth>
  <WindowTopX>120</WindowTopX>
  <WindowTopY>105</WindowTopY>
  <ProtectStructure>False</ProtectStructure>
  <ProtectWindows>False</ProtectWindows>
 </ExcelWorkbook>
 <Styles>
  <Style ss:ID="Default" ss:Name="Normal">
   <Alignment ss:Vertical="Bottom"/>
   <Borders/>
   <Font ss:FontName="Times New Roman" x:CharSet="204" x:Family="Swiss"
    ss:Size="14" ss:Color="#000000"/>
   <Interior/>
   <NumberFormat/>
   <Protection/>
  </Style>
  <Style ss:ID="s17">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
  </Style>
  <Style ss:ID="s18">
   <Alignment ss:Horizontal="Center" ss:Vertical="Top" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
  </Style>
  <Style ss:ID="s68">
   <Alignment ss:Horizontal="Right" ss:Vertical="Top" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <NumberFormat ss:Format="#,##0.00&quot;р.&quot;"/>
  </Style>
  <Style ss:ID="s69">
   <Alignment ss:Horizontal="Left" ss:Vertical="Top" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <NumberFormat ss:Format="@"/>
  </Style>
 </Styles>
 <Worksheet ss:Name="Лист1">
  <Table x:FullColumns="1"
   x:FullRows="1" ss:DefaultColumnWidth="60" ss:DefaultRowHeight="18.75">
   <Column ss:AutoFitWidth="0" ss:Width="49.5"/>
   <Column ss:AutoFitWidth="0" ss:Width="250.25"/>
   <Column ss:AutoFitWidth="0" ss:Width="159.75"/>
   <Column ss:AutoFitWidth="0" ss:Width="353.25"/>
   <Row ss:AutoFitHeight="0" ss:Height="39">
    <Cell ss:MergeAcross="3" ss:StyleID="s17"><Data ss:Type="String">Прайс-лист</Data></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="40.5">
    <Cell ss:StyleID="s17"><Data ss:Type="String">№</Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String">Название услуги</Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String">Стоимость за ед., руб.</Data></Cell>
	<Cell ss:StyleID="s17"><Data ss:Type="String">Описание</Data></Cell>
   </Row>
   
   <?php
	
		$number = 0;
		foreach ($services as $service)
		{   
			$number ++;
   echo 
   '<Row ss:AutoFitHeight="0" ss:Height="48">
    <Cell ss:StyleID="s18"><Data ss:Type="Number">'.$number.'</Data></Cell>
    <Cell ss:StyleID="s69"><Data ss:Type="String">'.\Yii::$app->formatter->asText($service->title).'</Data></Cell>
    <Cell ss:StyleID="s68"><Data ss:Type="Number">'.$service->cost.'</Data></Cell>
	<Cell ss:StyleID="s69"><Data ss:Type="String">'.\Yii::$app->formatter->asText($service->description).'</Data></Cell>
   </Row>
   ';
		}
   
   ?>
   
   
  </Table>
  <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
   <PageSetup>
    <Layout x:Orientation="Landscape"/>
    <Header x:Margin="0.3"/>
    <Footer x:Margin="0.3"/>
    <PageMargins x:Bottom="0.75" x:Left="0.7" x:Right="0.7" x:Top="0.75"/>
   </PageSetup>
   <Print>
    <ValidPrinterInfo/>
    <PaperSizeIndex>9</PaperSizeIndex>
    <HorizontalResolution>600</HorizontalResolution>
    <VerticalResolution>600</VerticalResolution>
   </Print>
   <Selected/>
   <Panes>
    <Pane>
     <Number>3</Number>
     <ActiveRow>6</ActiveRow>
     <ActiveCol>2</ActiveCol>
    </Pane>
   </Panes>
   <ProtectObjects>False</ProtectObjects>
   <ProtectScenarios>False</ProtectScenarios>
  </WorksheetOptions>
 </Worksheet>
 <Worksheet ss:Name="Лист2">
  <Table ss:ExpandedColumnCount="1" ss:ExpandedRowCount="1" x:FullColumns="1"
   x:FullRows="1" ss:DefaultColumnWidth="60" ss:DefaultRowHeight="18.75">
  </Table>
  <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
   <PageSetup>
    <Header x:Margin="0.3"/>
    <Footer x:Margin="0.3"/>
    <PageMargins x:Bottom="0.75" x:Left="0.7" x:Right="0.7" x:Top="0.75"/>
   </PageSetup>
   <ProtectObjects>False</ProtectObjects>
   <ProtectScenarios>False</ProtectScenarios>
  </WorksheetOptions>
 </Worksheet>
 <Worksheet ss:Name="Лист3">
  <Table ss:ExpandedColumnCount="1" ss:ExpandedRowCount="1" x:FullColumns="1"
   x:FullRows="1" ss:DefaultColumnWidth="60" ss:DefaultRowHeight="18.75">
  </Table>
  <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
   <PageSetup>
    <Header x:Margin="0.3"/>
    <Footer x:Margin="0.3"/>
    <PageMargins x:Bottom="0.75" x:Left="0.7" x:Right="0.7" x:Top="0.75"/>
   </PageSetup>
   <ProtectObjects>False</ProtectObjects>
   <ProtectScenarios>False</ProtectScenarios>
  </WorksheetOptions>
 </Worksheet>
</Workbook>
