// Function to transform raw data into a grouped structure
function transformData(data, idKey, nameKey) {
    const result = {};
    data.forEach(item => {
        const id = item[idKey];
        if (!result[id]) {
            result[id] = { name: item[nameKey] || `ID: ${id}`, products: [] };
        }
        result[id].products.push({ product_name: item.product_name, likes_number: item.likes_number });
    });
    return result;
}

// Transform the tops data
var transformedTops = {};
for (const criterion in tops) {
    switch (criterion) {
        case 'top_by_gender':
            transformedTops[criterion] = transformData(tops[criterion], 'gender_id', 'gender_name');
            break;
        case 'top_by_skintype':
            transformedTops[criterion] = transformData(tops[criterion], 'skintype_id', 'skintype_name');
            break;
        case 'top_by_social_status':
            transformedTops[criterion] = transformData(tops[criterion], 'social_status_id', 'social_status_name');
            break;
        case 'top_by_zone':
            transformedTops[criterion] = transformData(tops[criterion], 'zone_id', 'zone_name');
            break;
        case 'top_by_age_group':
            transformedTops[criterion] = transformData(tops[criterion], 'age_group_id', 'age_group_name');
            break;
        case 'top_by_time_of_day':
            transformedTops[criterion] = transformData(tops[criterion], 'time_of_day_id', 'time_of_day_name');
            break;
        case 'top_by_occasion':
            transformedTops[criterion] = transformData(tops[criterion], 'occasion_id', 'occasion_name');
            break;
        default:
            transformedTops[criterion] = tops[criterion];
    }
}

// Debugging: Log the transformed tops data
console.log(JSON.stringify(transformedTops, null, 2));

// HTML Generation
document.getElementById('generate-html-top').addEventListener('click', function() {
    let html = '';
    for (const criterion in transformedTops) {
        html += `<h2>Top by ${criterion.replace('top_by_', '').replace('_', ' ')}</h2>`;
        const criterionData = transformedTops[criterion];

        if (criterionData) {
            for (const id in criterionData) {
                if (criterionData[id] && criterionData[id].products) {
                    html += `<h3>${criterionData[id].name}</h3>`;
                    criterionData[id].products.forEach(product => {
                        html += `<p>${product.product_name} - ${product.likes_number} likes</p>`;
                    });
                }
            }
        }
    }

    var blob = new Blob([html], {type: 'text/html'});
    var url = URL.createObjectURL(blob);
    var link = document.createElement('a');
    link.href = url;
    link.download = 'top.html';
    link.click();
});

// RSS Generation
document.getElementById('generate-rss-top').addEventListener('click', function() {
    function escapeXml(unsafe) {
        return unsafe.replace(/[<>&'"]/g, function (c) {
            switch (c) {
                case '<': return '&lt;';
                case '>': return '&gt;';
                case '&': return '&amp;';
                case '\'': return '&apos;';
                case '"': return '&quot;';
            }
        });
    }

    let xml = '<?xml version="1.0" encoding="UTF-8" ?>';
    xml += '<rss version="2.0">';
    xml += '<channel>';
    xml += '<title>Top Products</title>';
    xml += '<link>http://www.example.com</link>';
    xml += '<description>Top products by various criteria</description>';

    for (const criterion in transformedTops) {
        const criterionData = transformedTops[criterion];

        if (criterionData) {
            for (const id in criterionData) {
                if (criterionData[id] && criterionData[id].products) {
                    xml += `<category>Top by ${escapeXml(criterion.replace('top_by_', '').replace('_', ' '))} - ${escapeXml(criterionData[id].name)}</category>`;
                    criterionData[id].products.forEach(product => {
                        xml += '<item>';
                        xml += `<title>${escapeXml(product.product_name)}</title>`;
                        xml += `<description>${escapeXml(product.likes_number.toString())} likes</description>`;
                        xml += '</item>';
                    });
                }
            }
        }
    }

    xml += '</channel>';
    xml += '</rss>';

    var blob = new Blob([xml], {type: 'application/rss+xml'});
    var url = URL.createObjectURL(blob);
    var link = document.createElement('a');
    link.href = url;
    link.download = 'top.rss';
    link.click();
});


// PDF Generation
document.getElementById('generate-pdf-top').addEventListener('click', function() {
    const { jsPDF } = window.jspdf;
    var doc = new jsPDF();

    let y = 10;
    const lineHeight = 10;
    const margin = 10;
    const pageHeight = doc.internal.pageSize.height;

    function addNewPage(doc) {
        doc.addPage();
        return margin; // Reset y position
    }

    for (const criterion in transformedTops) {
        if (y > pageHeight - margin) {
            y = addNewPage(doc);
        }
        doc.text(`Top by ${criterion.replace('top_by_', '').replace('_', ' ')}`, margin, y);
        y += lineHeight;

        const criterionData = transformedTops[criterion];
        if (criterionData) {
            for (const id in criterionData) {
                if (criterionData[id] && criterionData[id].products) {
                    if (y > pageHeight - margin) {
                        y = addNewPage(doc);
                    }
                    doc.text(`${criterionData[id].name}`, margin, y);
                    y += lineHeight;

                    criterionData[id].products.forEach(product => {
                        if (y > pageHeight - margin) {
                            y = addNewPage(doc);
                        }
                        doc.text(`${product.product_name} - ${product.likes_number} likes`, margin, y);
                        y += lineHeight;
                    });
                }
            }
        }
    }

    doc.save('top.pdf');
});

