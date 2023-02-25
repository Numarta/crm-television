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
  <Created>2016-05-08T16:48:50Z</Created>
  <LastSaved>2016-11-02T18:09:26Z</LastSaved>
  <Version>15.00</Version>
 </DocumentProperties>
 <OfficeDocumentSettings xmlns="urn:schemas-microsoft-com:office:office">
  <AllowPNG/>
 </OfficeDocumentSettings>
 <ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">
  <WindowHeight>4425</WindowHeight>
  <WindowWidth>19080</WindowWidth>
  <WindowTopX>600</WindowTopX>
  <WindowTopY>75</WindowTopY>
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
  <Style ss:ID="m225770284">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
  </Style>
  <Style ss:ID="m225770304">
   <Alignment ss:Horizontal="Center" ss:Vertical="Top"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
  </Style>
  <Style ss:ID="s16">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
  </Style>
  <Style ss:ID="s18">
   <Alignment ss:Vertical="Top"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
  </Style>
  <Style ss:ID="s20">
   <Alignment ss:Vertical="Top" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
  </Style>
  <Style ss:ID="s21">
   <Alignment ss:Horizontal="Center" ss:Vertical="Top"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
  </Style>
  <Style ss:ID="s24">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
  </Style>
  <Style ss:ID="s26">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Interior ss:Color="#C4BD97" ss:Pattern="Solid"/>
  </Style>
 </Styles>
 <Worksheet ss:Name="Лист1">
  <Table ss:ExpandedColumnCount="8"  x:FullColumns="1"
   x:FullRows="1" ss:DefaultColumnWidth="60" ss:DefaultRowHeight="18.75">
   <Column ss:AutoFitWidth="0" ss:Width="39"/>
   <Column ss:Index="3" ss:AutoFitWidth="0" ss:Width="84"/>
   <Column ss:AutoFitWidth="0" ss:Width="93.75"/>
   <Column ss:Index="6" ss:AutoFitWidth="0" ss:Width="86.25" ss:Span="2"/>
   <Row>
    <Cell ss:MergeAcross="7" ss:StyleID="s26"><Data ss:Type="String">Заказ</Data></Cell>
   </Row>
   <Row>
    <Cell ss:MergeAcross="2" ss:StyleID="s24"><Data ss:Type="String">Код заявки</Data></Cell>
    <Cell ss:MergeAcross="4" ss:StyleID="s24"><Data ss:Type="String"><?= $request->id ?></Data></Cell>
   </Row>
   <Row>
    <Cell ss:MergeAcross="2" ss:StyleID="s24"><Data ss:Type="String">Дата регистрации</Data></Cell>
    <Cell ss:MergeAcross="4" ss:StyleID="s24"><Data ss:Type="String"><?=  \Yii::$app->formatter->asDateTime($request->registration_date) ?></Data></Cell>
   </Row>
   <Row>
    <Cell ss:MergeAcross="2" ss:StyleID="s24"><Data ss:Type="String">Зарегистрировал</Data></Cell>
    <Cell ss:MergeAcross="4" ss:StyleID="s24"><Data ss:Type="String"><?= (empty ($request->idCreator) == false ? $request->idCreator->title : '') ?></Data></Cell>
   </Row>
   <Row>
    <Cell ss:MergeAcross="2" ss:StyleID="s24"><Data ss:Type="String">Статус</Data></Cell>
    <Cell ss:MergeAcross="4" ss:StyleID="s24"><Data ss:Type="String"><?= (empty ($request->idRequestStatus) == false ? $request->idRequestStatus->title : '') ?></Data></Cell>
   </Row>
   <Row>
    <Cell ss:MergeAcross="2" ss:StyleID="s24"><Data ss:Type="String">Стоимость, руб.</Data></Cell>
    <Cell ss:MergeAcross="4" ss:StyleID="s24"><Data ss:Type="String"><?= $request->cost ?></Data></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="48.75">
    <Cell ss:MergeAcross="2" ss:StyleID="s21"><Data ss:Type="String">Описание</Data></Cell>
    <Cell ss:MergeAcross="4" ss:StyleID="s24"><Data ss:Type="String"><?= \Yii::$app->formatter->asText($request->description) ?></Data></Cell>
   </Row>
   <Row>
    <Cell ss:MergeAcross="2" ss:StyleID="s24"><Data ss:Type="String">Исполнитель</Data></Cell>
    <Cell ss:MergeAcross="4" ss:StyleID="s24"><Data ss:Type="String"><?= (empty ($request->idExecutor) == false ? $request->idExecutor->title : '') ?></Data></Cell>
   </Row>
   <Row ss:Index="13">
    <Cell ss:MergeAcross="7" ss:StyleID="s26"><Data ss:Type="String">Услуги</Data></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="36.75">
    <Cell ss:StyleID="s16"><Data ss:Type="String">№</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">Услуга</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">Стоимость за ед., руб.</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">Кол-во</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">Стоимость, руб.</Data></Cell>
    <Cell ss:MergeAcross="2" ss:StyleID="m225770284"><Data ss:Type="String">Описание</Data></Cell>
   </Row>
   
   <?php
	
		$number = 0;
		foreach ($request_services as $request_service)
		{   
			$number ++;
   echo '<Row ss:AutoFitHeight="0" ss:Height="72">
    <Cell ss:StyleID="s21"><Data ss:Type="Number">'.$number.'</Data></Cell>
    <Cell ss:StyleID="s20"><Data ss:Type="String">'.(empty ($request_service->idService) == false ? $request_service->idService->title : '').'</Data></Cell>
    <Cell ss:StyleID="s18"><Data ss:Type="Number">'.$request_service->cost.'</Data></Cell>
    <Cell ss:StyleID="s21"><Data ss:Type="Number">'.$request_service->amount.'</Data></Cell>
    <Cell ss:StyleID="s18"><Data ss:Type="Number">'.$request_service->total.'</Data></Cell>
    <Cell ss:MergeAcross="2" ss:StyleID="m225770304"><Data ss:Type="String">'.\Yii::$app->formatter->asText($request_service->description).'</Data></Cell>
   </Row>';
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
     <ActiveRow>7</ActiveRow>
     <ActiveCol>10</ActiveCol>
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