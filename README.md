# TYPONiels Techradar-Extension for TYPO3

With this extension, [My Techradar](https://radar.niels-langlotz.com) can be easily imported into TYPO3 to have the data directly in the CMS (e.g. for Solr).

---

### Installation

You can download the extension as a zip or install it directly via Composer.

`composer require typoniels/techradar`

To get the Extension directly from this Gitlab please add the following to your composer.json

<pre>
"repositories": [
    {
        "type": "vcs",
        "url": "https://www.halle-development.com/typoniels-extensions/techradar.git"
    },
]
</pre>

---

### Setup of the Downloads-Extension

1. The Setup of the Extension is quite easy. Just Install and activate it in the extensionmanager.
2. Create a sysfolder-page in your sitetree
3. Fill in the Connection Details into the Extension Configuration (BE Module)
4. Create Scheduler Task to bring the Data into TYPO3
5. Add TYPOScript Template for preconfigured Solr-Config (Filter, Indexer)

---

### Features
- Import Data from Headless CMS Cockpit to TYPO3
- Add Techradar/Lernplan to Solr
- Convert Images to FAL

---

### Upcoming Features | v2
- Seperated Solr-Indexer to avoid not valid Items (e.g. offline / incorrect links)
- Develop a generic TYPO3-Cockpit Connector
- ...

---

### TODOs / Known Problems
- Nothing yet

---

### Found a Bug?
Feel free to [write me a mail](info@typomiels.de) or create a Issue direct in the [Gitlab Issue-Tracker](https://www.halle-development.com/typoniels-extensions/techradar/-/issues). Contribution is always welcome.

---

**You need a customized TYPO3 solution?**<br>
Niels Langlotz | [typoniels.de](https://www.typoniels.de/info)